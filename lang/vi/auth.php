<?php

return [
    'failed' => 'Thông tin đăng nhập không chính xác.',
    'password' => 'Mật khẩu không chính xác.',
    'throttle' => 'Bạn đăng nhập quá nhiều lần. Vui lòng thử lại sau :seconds giây.',

    'labels' => [
        'name' => 'Họ và tên',
        'email' => 'Email',
        'password' => 'Mật khẩu',
        'password_confirmation' => 'Xác nhận mật khẩu',
        'remember_me' => 'Ghi nhớ đăng nhập',
    ],

    'actions' => [
        'login' => 'Đăng nhập',
        'logout' => 'Đăng xuất',
        'register' => 'Đăng ký',
        'confirm' => 'Xác nhận',
        'reset_password' => 'Đặt lại mật khẩu',
        'send_reset_link' => 'Gửi liên kết đặt lại mật khẩu',
        'back_to_login' => 'Quay lại đăng nhập',
        'resend_verification_email' => 'Gửi lại email xác minh',
    ],

    'titles' => [
        'register' => 'Bắt đầu ngay',
        'login' => 'Chào mừng trở lại',
        'forgot_password' => 'Quên mật khẩu?',
    ],

    'descriptions' => [
        'register' => 'Nhập thông tin của bạn để tạo tài khoản',
        'login' => 'Nhập thông tin đăng nhập để truy cập tài khoản',
        'forgot_password' => 'Đừng lo, chúng tôi sẽ hỗ trợ bạn.',
        'confirm_password' => 'Đây là khu vực bảo mật của hệ thống. Vui lòng xác nhận mật khẩu trước khi tiếp tục.',
        'forgot_password_help' => 'Nhập email tài khoản của bạn, chúng tôi sẽ gửi liên kết để bạn đặt lại mật khẩu mới.',
        'forgot_password_log_mailer' => 'Môi trường hiện tại đang dùng MAIL_MAILER=log, nên email sẽ không được gửi ra hộp thư thật. Sau khi bấm gửi, hãy mở file storage/logs/laravel.log để lấy liên kết đặt lại mật khẩu.',
        'verify_email_help' => 'Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, vui lòng xác minh địa chỉ email bằng cách nhấp vào liên kết chúng tôi vừa gửi cho bạn. Nếu bạn chưa nhận được email, chúng tôi sẽ gửi lại cho bạn.',
        'verification_link_sent' => 'Một liên kết xác minh mới đã được gửi đến địa chỉ email bạn đã cung cấp khi đăng ký.',
    ],

    'links' => [
        'forgot_password' => 'Quên mật khẩu?',
    ],

    'prompts' => [
        'already_have_account' => 'Bạn đã có tài khoản?',
        'dont_have_account' => 'Bạn chưa có tài khoản?',
    ],
];
