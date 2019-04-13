<?php
/**
 * Created by PhpStorm.
 * User: LixWorth
 * Date: 2019/4/14
 * Time: 0:44
 */
?><!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>PassPort - Amadeus Server Manage</title>

    <link rel="stylesheet" href="{{ asset('app.sass') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
</head>
<body>
<div id="app">
    <passport/>
</div>

<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
