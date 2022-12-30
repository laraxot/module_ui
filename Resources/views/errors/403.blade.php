@extends('ui::errors.illustrated-layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', $message ?? __('Forbidden'))
