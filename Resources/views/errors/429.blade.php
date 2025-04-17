@extends('ui::errors.illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', $message ?? __('Too Many Requests'))
