<?php

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    public function testLoginSuccess()
    {
        $_POST['loginEmail'] = 'test@example.com'; // Replace with a valid test email
        $_POST['loginPassword'] = 'password123'; // Replace with a valid test password

        ob_start();
        require 'C:\xampp\htdocs\projetweb\includes\login.php'; // Replace with the actual path to your login script
        $output = ob_get_clean();

        $this->assertEquals('Login successful', $output);
    }

    public function testLoginFailure()
    {
        // Test login with incorrect credentials
        $_POST['loginEmail'] = 'test@example.com'; // Replace with a valid test email
        $_POST['loginPassword'] = 'wrongpassword'; // Replace with an incorrect password

        ob_start();
        require 'C:\xampp\htdocs\projetweb\includes\login.php'; // Replace with the actual path to your login script
        $output = ob_get_clean();

        $this->assertEquals('Login failed', $output);

        // You can add more test cases for different scenarios
    }
}
