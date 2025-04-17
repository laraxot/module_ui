@extends('ui::errors.illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', $message ?? __('Service Unavailable'))
