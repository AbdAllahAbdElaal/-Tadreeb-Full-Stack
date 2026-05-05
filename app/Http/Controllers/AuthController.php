<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. التحقق من أن الحقول المدخلة صحيحة وغير فارغة
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean',
        ]);

        $credentials = $request->only('email', 'password');

        // 3. محاولة تسجيل الدخول (لارافيل سيبحث في جدول users أو members حسب إعداداتك)
        // بما انو احنا شغالين على جدول members، تأكد انك غيرت user->model في config/auth.php إلى Member::class

        // يجب أن نوجه لارافيل ليستخدم موديل Member كالمصدر الأساسي للمستخدمين.
        // افتح ملف config/auth.php وانزل إلى قسم providers. قم بتغيير الموديل في مزود users ليصبح هكذا:
            // 'providers' => [
            //     'users' => [
            //         'driver' => 'eloquent',
            //         'model' => App\Models\Member::class, // التعديل هنا
            //     ],
            // ],


        if (Auth::attempt($credentials)) {

            // حماية الجلسة (مهم جداً أمنياً)
            $request->session()->regenerate();

            // إذا كانت البيانات صحيحة، نجلب بيانات المستخدم الذي دخل للتو
            $user = Auth::user();

            // تحديد رابط التوجيه بناءً على صلاحية المستخدم (Role)
            $redirectUrl = '';

            switch ($user->role) {
                case 'admin':
                    $redirectUrl = route('admin-dashboard');
                    break;
                case 'organization':
                    if($user->organization->role === 'university'){
                        if($user->organization->university->status === 'active'){
                            $redirectUrl = route('university-dashboard');
                            break;
                        }else{
                            Auth::logout();
                            return response()->json(['status' => 'error', 'message' => 'حساب الجامعة غير مفعل. يرجى التواصل مع الإدارة.'], 403);
                        }
                    }else{
                        if($user->organization->company->status === 'active'){
                            $redirectUrl = route('company-dashboard');
                            break;
                        }else{
                            Auth::logout();
                            return response()->json(['status' => 'error', 'message' => 'حساب الشركة غير مفعل. يرجى التواصل مع الإدارة.'], 403);
                        }
                    }
                case 'student':
                    if($user->student->status !== 'pending'){
                        $redirectUrl = route('student-dashboard');
                        break;
                    }else{
                        Auth::logout(); 
                        return response()->json(['status' => 'error', 'message' => 'حساب الطالب غير مفعل. يرجى التواصل مع الإدارة.'], 403);
                    }

                default:
                    Auth::logout();
                    return response()->json(['status' => 'error', 'message' => 'حسابك لا يملك صلاحيات الدخول.'], 403);
            }

            // 5. إرسال الاستجابة الناجحة إلى الجافاسكريبت مع الرابط المخصص
            return response()->json([
                'status' => 'success',
                'user_id' => $user->id,
                'redirect' => $redirectUrl // الرابط تم تحديده حسب الرول
            ], 200);

        } else {
            // فشل تسجيل الدخول (الإيميل غير موجود أو كلمة السر خاطئة)
            return response()->json([
                'status' => 'error',
                'message' => 'الإيميل أو كلمة المرور غير صحيحة، يرجى المحاولة مرة أخرى.'
            ], 400); // إرجاع خطأ 400 لكي يفهمه Axios وينفذ قسم .catch
        }
    }
}
