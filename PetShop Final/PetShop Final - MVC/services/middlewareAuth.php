<?php

    class MiddlewareAuth
    {
        public static function checkAuth(string $rotaRedirecionamento = '/login')
        {   # sessao do usuario
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if(empty($_SESSION['login']) &&  empty($_SESSION['usuario_nome'])){
                // Redireciona para uma página protegida, ex: dashboard.php
                 header("Location: $rotaRedirecionamento");
                 exit;
            }
        }

        public static function isAuthenticated(string $rotaRedirecionamento = '/dashboard')
        {   # sessao do usuario
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if(isset($_SESSION['login']) &&  isset($_SESSION['usuario_nome'])){
                header("Location: $rotaRedirecionamento");
                exit;
            }
        }
    }
?>