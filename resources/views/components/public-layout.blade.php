@props(['title' => 'My Coach Pro'])

@php($pageTitle = $title)

@include('layouts.public', ['title' => $pageTitle, 'slot' => $slot])
