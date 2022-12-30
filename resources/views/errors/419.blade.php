@extends('ui::errors.illustrated-layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', $message ?? __('Page Expired'))
