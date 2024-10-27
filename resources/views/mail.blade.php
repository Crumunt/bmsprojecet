@extends('layouts.app-layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/email.css') }}">
@endpush

@php
    $sectionClass = 'p-0';
    $extraClasses = 'vh-100 d-flex flex-row p-0 pt-1';
@endphp
@section('main-content')
    <div class="sidebar pt-5 position-sticky">
        <button class="compose-btn" data-bs-target="#emailModal" data-bs-toggle="modal"><i class="fa fa-plus"></i> Compose
            Mail</button>
        <div class="folders">
            <h4>Folders</h4>
            <ul>
                <li><i class="uik uil-inbox"></i> Inbox <span class="count">16</span></li>
                <li><i class="uil uil-telegram-alt"></i> Send Mail</li>
                <li><i class="uil uil-star"></i> Important</li>
                <li><i class="uil uil-file"></i> Drafts <span class="count">2</span></li>
                <li><i class="uil uil-trash"></i> Trash</li>
            </ul>
        </div>
        <div class="categories">
            <h4>Categories</h4>
            <ul>
                <li><span class="dot work"></span> Work</li>
                <li><span class="dot documents"></span> Documents</li>
                {{-- <li><span class="dot social"></span> Social</li> --}}
                <li><span class="dot advertising"></span> Contractors</li>
                <li><span class="dot clients"></span> Clients</li>
            </ul>
        </div>
        {{-- <div class="labels">
            <h4>Labels</h4>
            <div class="label-tags">
                <span class="label">Family</span>
                <span class="label">Work</span>
                <span class="label">Home</span>
                <span class="label">Children</span>
                <span class="label">Holidays</span>
                <span class="label">Music</span>
                <span class="label">Photography</span>
                <span class="label">Film</span>
            </div>
        </div> --}}
    </div>
    <div class="main-content">
        <div class="inbox">
            <div class="inbox-header">
                <div class="dashboard-title">
                    <h1>Inbox (69)</h1>
                </div>
                <div class="header-controls">
                    <div class="inbox-controls">
                        <button class="btn-refresh"><i class="uil uil-sync"></i></button>
                        <button class="btn-view"><i class="uil uil-eye"></i></button>
                        <button class="btn-flag"><i class="uil uil-exclamation-octagon"></i></button>
                        <button class="btn-delete"><i class="uil uil-trash"></i></button>
                    </div>
                    <div class="input-box">
                        <i class="uil uil-search"></i>
                        <input type="text" placeholder="Search here...">
                        <button class="button1">Search</button>
                    </div>

                </div>
                <table class="product-table table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th class="col-1">Select</th>
                            <th class="col-3">User</th>
                            <th class="col-3">Subject</th>
                            <th class="col-2">Type</th>
                            <th class="col-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $collection = ['pending' => 'Unread', 'active' => 'Read', 'inactive' => 'Report'];
                        @endphp
                        @for ($i = 0; $i < 10; $i++)
                            @php
                                $key = array_rand($collection);
                            @endphp
                            <tr>
                                <td class="col-1"><input type="checkbox"></td>
                                <td class="col-3"><img src="{{ asset('assets/images/avatar1.jpg') }}" class="product-icon">
                                    Kim domingo</td>
                                <td class="text-truncate" style="max-width: 100px">
                                    {{ strip_tags(file_get_contents('http://loripsum.net/api/10/short/headers')) }}</td>
                                <td class="col-2">Sub-Admin</td>
                                <td class="col-2"><span class="status {{ $key }}">{{ $collection[$key] }}</span>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <div class="pagination-container">
                    <div class="pagination-number arrow">
                        <svg width="18" height="18">
                            <use xlink:href="#left"></use>
                        </svg>
                        <span class="arrow-text">Previous</span>
                    </div>

                    <div class="pagination-number">1</div>
                    <div class="pagination-number">2</div>
                    <div class="pagination-number pagination-active">3</div>
                    <div class="pagination-number">4</div>
                    <div class="pagination-number">540</div>

                    <div class="pagination-number arrow">
                        <svg width="18" height="18">
                            <use xlink:href="#right"></use>
                        </svg>
                    </div>
                </div>

                <svg class="hide">
                    <symbol id="left" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </symbol>
                    <symbol id="right" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </symbol>
                </svg>

                <x-manage-projects.modal modalID="emailModal" modalSize="lg" headerAddon="bg-success text-white">
                    <x-slot:pageTitle>
                        <i class="fa fa-envelope"></i> New Message
                    </x-slot:pageTitle>
                    <div class="form-group">
                        <label for="emailFrom">From:</label>
                        <input type="email" id="emailFrom" class="modal-input" value="hypebits@gmail.com" readonly />
                    </div>
                    <div class="form-group">
                        <label for="emailTo">To:</label>
                        <input type="text" id="emailTo" class="modal-input" placeholder="To" />
                    </div>


                    <div class="form-group">
                        <label for="emailSubject">Subject:</label>
                        <input type="text" id="emailSubject" class="modal-input" placeholder="Subject" />
                    </div>
                    <div class="form-group">
                        <textarea id="emailBody" class="modal-input body-textarea" placeholder="Compose your email"></textarea>
                    </div>

                    <x-slot:modalControls>
                        <button class="btn btn-secondary send-later">Send Later</button>
                        <button class="btn btn-success send-email">Send</button>
                    </x-slot:modalControls>
                </x-manage-projects.modal>
            </div>
        </div>
    </div>
@endsection
