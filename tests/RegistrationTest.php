<?php

use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase
{
    public function testRegistrationSuccess()
    {
        $_POST['registerPhone'] = '1234567890';
        $_POST['registerEmail'] = 'test@example.com';
        $_POST['registerUsername'] = 'testuser';
        $_POST['registerPassword'] = 'password123';

        ob_start();
        require 'C:\xampp\htdocs\projetweb\includes\register.php'; // Replace with the actual path to your registration script
        $output = ob_get_clean();

        $this->assertEquals('you are registered', 'you are registered');
    }

    public function testRegistrationFailure()
    {
        // Test registration with missing fields
        $_POST['registerPhone'] = '';
        $_POST['registerEmail'] = 'test@example.com';
        $_POST['registerUsername'] = 'testuser';
        $_POST['registerPassword'] = 'password123';

        ob_start();
        require 'C:\xampp\htdocs\projetweb\includes\register.php'; // Replace with the actual path to your registration script
        $output = ob_get_clean();

        $this->assertEquals('Please fill in all the required fields.','Please fill in all the required fields.');

        // You can add more test cases for different scenarios
    }
}
