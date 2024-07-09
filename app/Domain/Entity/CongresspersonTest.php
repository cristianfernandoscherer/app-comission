<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Entity\Congressperson;

class CongresspersonTest extends TestCase
{
    public function testCongresspersonIsValid()
    {
        $congressperson = new Congressperson(
            'John Doe',
            'qK9vT@example.com',
            new DateTime('1990-01-01'),
            '51997782134',
            '07867139095',
            'Curso superior completo',
            'www.google.com/photo.jpg',
            'RS',
            'PT'
        );

        $method = new ReflectionMethod($congressperson, 'isValid');
        $method->setAccessible(true);
        $this->assertEmpty($method->invoke($congressperson));
    }

    public function testCongresspersonInvalidRequired()
    {
        $error = "";
        try {
            new Congressperson(
                "",
                'qK9vT@example.com',
                new DateTime('1990-01-01'),
                '51997782134',
                '07867139095',
                'Curso superior completo',
                'www.google.com/photo.jpg',
                'RS',
                'PT'
            );
        } catch (Exception $err) {
            $error = $err->getMessage();
        }

        $this->assertEquals($error,  "Name is required");
    }

    public function testCongresspersonInvalidCPF()
    {
        $error = "";
        try {
            new Congressperson(
                "Teste",
                'qK9vT@example.com',
                new DateTime('1990-01-01'),
                '51997782134',
                '11111111111',
                'Curso superior completo',
                'www.google.com/photo.jpg',
                'RS',
                'PT'
            );
        } catch (Exception $err) {
            $error = $err->getMessage();
        }

        $this->assertEquals($error,  "Invalid CPF");
    }

    public function testCongresspersonInvalidEmail()
    {
        $error = "";
        try {
            new Congressperson(
                "Teste",
                'qK9vT.com',
                new DateTime('1990-01-01'),
                '51997782134',
                '07867139095',
                'Curso superior completo',
                'www.google.com/photo.jpg',
                'RS',
                'PT'
            );
        } catch (Exception $err) {
            $error = $err->getMessage();
        }

        $this->assertEquals($error,  "Invalid email");
    }
}
