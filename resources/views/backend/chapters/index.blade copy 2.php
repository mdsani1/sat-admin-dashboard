<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <a data-toggle="modal" data-target="#chapterModal" class="create-button btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm" style="background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px">
                    <i class="fas fa-plus" style="font-size: 12px; margin-right: 5px; margin-top: 5px;"></i> Manage Chapter
                </a>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'Manage Chapter'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="d-none" id="chapterNullList">
        <x-backend.layouts.partials.blocks.empty-state
            title="add chapter"
            message=""
            buttonText="Add Chapter"
            buttonRoute="#chapterModal"
        />
    </div>

    <div id="chapterList">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between">
                <div>
                    <input type="text" id="search" class="form-control search_input" placeholder="Search Chapter" style="padding-left: 40px">
                </div>
                <div class="d-flex">
                    <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;">
                        <img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters
                    </button>
                </div>
            </div>
            <div class="card-body p-0 m-0 table-responsive">
                <div class="d-flex justify-content-between align-items-center mt-3 p-2">
                    <h4><strong id="total-chapters"></strong></h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr class="bg-light">
                                <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                <th>Chapter Name</th>
                                <th>Audience</th>
                                <th>Subject</th>
                                <th>Created</th>
                                <th>State</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="chapter-table-body">
                            <tr>
                                <td colspan="7" class="text-center">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2 p-2" style="border-top: 1px solid #D0D5DD; background:#F9FAFB">
                    <div id="pagination-info"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mr-2">
                            <span class="me-2 pr-2">Rows per page</span>
                            <select id="rowsPerPage" class="form-control form-select-sm" style="width: 60px;">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm" id="pagination-links"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <section>
        <div class="modal fade" id="chapterModal" tabindex="-1" role="dialog" aria-labelledby="chapterModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="width:60%">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                        <h5 class=""><b id="chapterpleModalLongTitle">Create Chapter</b></h5>
                        <p class="pb-2">Step 1 : Choose Audience, Subject, title and description to Get Started</p>
                    </div>
                    <div class="modal-body" style="height: 620px;">
                        <div>
                            <label class="label-header" for="">1. Select the Audience</label>
                            <div class="row" style="margin-left: 3px">
                                <div class="col-md-6 row">
                                    <label class="radio-container mb-3 col-md-12 custom-radio">
                                        <input class="sat_1" type="radio" name="audience" value="High School"> High School
                                    </label>
                                    <label class="radio-container mb-3 col-md-12 custom-radio">
                                        <input class="sat_1" type="radio" name="audience" value="Graduation"> Graduation
                                    </label>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="radio-container mb-3 col-md-12 custom-radio">
                                        <input class="sat_1" type="radio" name="audience" value="College"> College
                                    </label>
                                    <label class="radio-container mb-3 col-md-12 custom-radio">
                                        <input class="sat_2" type="radio" name="audience" value="SAT 2"> SAT 2
                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <div id="sat_type_1" class="d-none">
                                    <h5 class="mt-3 label-header">2. Select the Question Type</h5>
                                    <div class="row">
                                        <div class="col-md-12 row">
                                            <div class="col-md-6 mb-2">
                                                <label class="radio-container mb-3 col-md-12">
                                                    <input class="" type="radio" name="question_type" value="Verbal"> Verbal
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="radio-container mb-3 col-md-12">
                                                    <input class="" type="radio" name="question_type" value="Quant"> Quant
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sat_type_2" class="d-none">
                                    <h5 class="mt-3"><strong>2. Select the Question Subject</strong></h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="radio-container mb-3 col-md-12">
                                                <input class="" type="radio" name="subjects" value="Physics"> Physics
                                            </label>
                                            <label class="radio-container mb-3 col-md-12">
                                                <input class="" type="radio" name="subjects" value="Chemistry"> Chemistry
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="radio-container mb-3 col-md-12">
                                                <input class="" type="radio" name="subjects" value="Biology"> Biology
                                            </label>
                                            <label class="radio-container mb-3 col-md-12">
                                                <input class="" type="radio" name="subjects" value="Math"> Math
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between;">
                                        <label class="label-header" for="">Title</label>
                                    </div>
                                    <input type="text" class="form-control" max="" id="title" name="title" placeholder="">
                                </div>
                            </div>

                            <div>
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between;">
                                        <label class="label-header" for="">Description</label>
                                    </div>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="5" max="500"></textarea>
                                    <p class="text-right" style="color: #475467">429 /500 character Maximum </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3" style="width: 100%; bottom: 0px !important; position: absolute;">
                        <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                        <a href="#" class="btn save-chapter" style="background-color:#691D5E; border-radius: 8px; color:#D0D5DD">Add Chapters</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Sidebar -->
    <div class="sidebar-overlay" id="taskSidebarOverlay"></div>
    <div class="floating-sidebar" id="taskSidebar">
        <div class="filter">
            <div class="sidebar-header">
                <div>
                    <h4 style="font-size: 18px;" class="p-0 m-0">Filters</h4>
                    <p class="p-0 m-0" style="color: #475467">Apply filters to table data.</p>
                </div>
                <button type="button" class="close-btn" id="closeSidebar">×</button>
            </div>
            <div class="filter-sidebar-content">
                <div class="task-form">
                    <div class="pt-3 pr-3 pb-3 pl-0">
                        <div class="d-flex justify-content-between">
                            <p style="font-size: 12px"><span style="color: #344054"><b>Created on:</b></span> <span style="color: #475467">06 Jan 25 - 12 Jan 25</span></p>
                            <button class="reset-slider"><u>Reset</u></button>
                        </div>
                        <div class="mt-1 mb-2 d-flex justify-content-between">
                            <div style="width: 49%">
                                <input type="date" class="form-control" name="crated_start_at">
                            </div>
                            <div style="align-items: center; display: flex; width:1%">-</div>
                            <div style="width: 49%">
                                <input type="date" class="form-control" name="crated_end_at">
                            </div>
                        </div>
                        <div id="filter-status">
                            <div class="d-flex justify-content-between">
                                <h6><b>Status:</b> Active Only</h6>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="all" value="All" checked>
                                <label class="form-check-label" for="all">All</label>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="activeonly" value="Active only">
                                <label class="form-check-label" for="activeonly">Active only</label>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="inactiveonly" value="Inactive only">
                                <label class="form-check-label" for="inactiveonly">Inactive only</label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between">
                                <h6><b>Audience & Type:</b> All Result</h6>
                            </div>
                            <div id="all_sat_type_1">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="toggle-parent" type="checkbox" id="allSet1Toggle">
                                        <label class="form-check-label" for="allSet1Toggle">All SAT 1</label>
                                        <span class="toggle-icon" data-target="allSet1"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="allSet1">
                                        <div class="form-check">
                                            <input type="checkbox" value="High School" name="audience[]">High School
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Graduation" name="audience[]">Graduation
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="College" name="audience[]">College
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="all_sat_type_2">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="toggle-parent" type="checkbox" id="allSet2Toggle">
                                        <label class="form-check-label" for="allSet2Toggle">All SAT 2</label>
                                        <span class="toggle-icon" data-target="allSet2"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="allSet2">
                                        <div class="form-check">
                                            <input type="checkbox" value="SAT 2" name="audience[]">SAT 2
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="section_types">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="toggle-parent" type="checkbox" id="sectionTypeToggle">
                                        <label class="form-check-label" for="sectionTypeToggle">Section Types</label>
                                        <span class="toggle-icon" data-target="sectionTypes"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="sectionTypes">
                                        <div class="form-check">
                                            <input type="checkbox" value="Physics" name="sat_type[]">Physics
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Chemistry" name="sat_type[]">Chemistry
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Biology" name="sat_type[]">Biology
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Math" name="sat_type[]">Math
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Verbal" name="sat_type[]">Verbal
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Quant" name="sat_type[]">Quant
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Mixed" name="sat_type[]">Mixed
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top fixed-bottom-buttons">
                <div class="d-flex justify-content-between p-3">
                    <button type="button" class="btn apply-filter-btn" style="background-color:#691D5E; border-radius: 4px; color:#fff; width:50%">Apply Filters</button>
                    <button type="button" class="btn btn-outline-dark ml-2 reset-filter" style="border: 1px solid #D0D5DD; border-radius: 4px; width:50%;">Reset All</button>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <style>
        #chartdiv, #areaChartdiv {
            width: 100%;
            height: 300px;
        }

        input[type="radio"] {
            accent-color: #691D5e;
        }

        .label-header {
            font-size: 16px;
            font-weight: bold;
        }

        .search_input {
            width: 400px;
            padding: 12px 24px;
            background-color: transparent;
            font-size: 14px;
            color: #575756;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 0 3 3 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: 18px 18px;
            background-position: 10px center;
            border-radius: 50px;
            padding-left: 36px;
        }

        .search_input::placeholder {
            padding-left: 30px;
        }

        .nav-tabs {
            border: 1px solid #ddd;
            background-color: #F9FAFB;
            border-radius: 8px;
        }

        .nav-tabs .nav-link.active {
            color: #000;
            background-color: #fff;
            border-color: transparent;
            padding: 8px;
            margin-top: 3px;
            margin-left: 3px;
            border-radius: 7px;
            font-weight: bold;
        }

        .nav-tabs .nav-link:hover {
            background-color: transparent;
            color: #333;
            border-radius: 8px;
        }

        input[type='checkbox'] {
            width: 20px;
            height: 20px;
            border: 1px solid #D0D5DD;
            appearance: none;
            background-color: white;
            cursor: pointer;
            border-radius: 4px !important;
        }

        input[type='checkbox']:checked {
            background-color: #3F1239;
            position: relative;
        }

        input[type='checkbox']:checked::after {
            content: '✓';
            font-size: 12px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .dataTable tbody > tr.selected, .dataTable tbody > tr > .selected {
            background-color: #F1E9F0;
        }

        .change-btn {
            color: #ffffff;
            background-color: #521749;
            border: 1px solid #A16A99;
            width: 80px;
            border-radius: 5px;
            font-weight: bold;
        }

        .modal .form-check {
            border: 1px solid #D0D5DD;
            border-radius: 8px;
            height: 44px;
            display: flex;
            align-items: center;
            padding-left: 46px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-radio .form-check-input:checked ~ .form-check {
            background-color: #F1E9F0;
            border-color: #A16A99;
        }

        .form-check-input:checked {
            background-color: #732066;
            border-color: #732066;
            margin: 2px;
        }

        .form-check-input:checked + .form-check-label {
            color: #344054;
            font-weight: 500;
        }

        .form-check:hover {
            border-color: #732066;
        }

        .form-check-input {
            position: absolute;
            opacity: 0;
        }

        .form-check-label {
            position: relative;
            cursor: pointer;
        }

        .custom-radio .form-check-label::before {
            content: "";
            position: absolute;
            left: -30px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            border: 2px solid #D0D5DD;
            border-radius: 50%;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .custom-radio .form-check-input:checked + .form-check-label::before {
            border-color: #732066;
            background-color: #732066;
            box-shadow: 0 0 0 2px white, 0 0 0 4px #732066;
        }

        .status-radio .form-check-label::before {
            content: "";
            position: absolute;
            left: -30px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            border: 2px solid #D0D5DD;
            border-radius: 50%;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .status-radio .form-check-input:checked + .form-check-label::before {
            border-color: #732066;
            background-color: #732066;
            width: 10px;
            height: 10px;
            margin-left: 4px;
            box-shadow: 0 0 0 2px white, 0 0 0 4px #732066;
        }

        .form-check-input:checked ~ .form-check-label {
            color: #344054;
            font-weight: 500;
        }

        .custom-radio:has(.form-check-input:checked) {
            background-color: #F1E9F0;
            border-color: #A16A99;
        }

        .floating-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease-in-out;
            z-index: 1050;
            display: flex;
            flex-direction: column;
        }

        .filter-sidebar-content {
            flex-grow: 1;
            height: calc(100vh - 120px);
            overflow-y: auto;
            padding-left: 15px;
            padding-bottom: 60px;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
        }

        .sidebar-header {
            padding: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #D0D5DD;
        }

        .floating-sidebar.open {
            right: 0;
        }

        .sidebar-overlay.active {
            display: block;
        }

        .filter-group {
            margin-bottom: 10px;
        }

        .form-check {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 8px;
            cursor: pointer;
        }

        .nested-options {
            margin-left: 24px;
            display: none;
        }

        .toggle-icon {
            cursor: pointer;
            font-size: 14px;
            transition: transform 0.3s ease-in-out;
            margin-left: auto;
        }

        .toggle-icon.open {
            transform: rotate(180deg);
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            accent-color: #4B1D3F;
        }

        .form-check-label {
            font-size: 14px;
            color: #333;
        }

        .slider-container {
            width: 100%;
            max-width: 300px;
            font-family: Arial, sans-serif;
        }

        .slider-header {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .reset-slider {
            background: none;
            border: none;
            color: black;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            text-decoration: underline;
        }

        .range-slider {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .range-slider input {
            -webkit-appearance: none;
            width: 100%;
            position: absolute;
            background: transparent;
            pointer-events: none;
        }

        .range-slider input::-webkit-slider-runnable-track {
            background: #E0E0E0;
            height: 4px;
            border-radius: 2px;
        }

        .range-slider input::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            background: white;
            border: 3px solid #69275C;
            border-radius: 50%;
            cursor: pointer;
            pointer-events: auto;
            margin-top: -6px;
        }

        .slider-labels {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: 8px;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }

        .task-form .form-control {
            border: 1px solid #ddd;
            padding-left: 4px;
            padding-right: 4px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 22px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 22px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #22c55e;
        }

        input:checked+.slider:before {
            transform: translateX(18px);
        }

        .new-question, .next-step, .back-btn {
            border-radius: 8px;
        }

        .modal-content {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }

        .badge-pill {
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 14px;
        }

        .badge-easy { background-color: #d4edda; color: #28a745; border: 1px solid #28a745; }
        .badge-medium { background-color: #d1ecf1; color: #17a2b8; border: 1px solid #17a2b8; }
        .badge-hard { background-color: #fff3cd; color: #fab905; border: 1px solid #fab905; }
        .badge-very-hard { background-color: #f8d7da; color: #dc3545; border: 1px solid #dc3545; }

    </style>
    @endpush

    @push('js')
    <script>
        $(document).ready(function() {
            $(".sat_2").change(function() {
                $('#sat_type_1').find('input').prop('checked', false);
                $("#sat_type_2").removeClass("d-none");
                $("#sat_type_1").addClass("d-none");
            });

            $(".sat_1").change(function() {
                $('#sat_type_2').find('input').prop('checked', false);
                $("#sat_type_1").removeClass("d-none");
                $("#sat_type_2").addClass("d-none");
            });

            // Sidebar toggle
            $('#closeSidebar, #taskSidebarOverlay').on('click', function() {
                $('#taskSidebar').removeClass('open');
                $('#taskSidebarOverlay').removeClass('active');
            });

            // Filter sidebar toggle
            window.filter = function(button) {
                $('#taskSidebar').addClass('open');
                $('#taskSidebarOverlay').addClass('active');
            };

            // Filter dropdowns
            $('.toggle-icon').on('click', function() {
                const target = $('#' + $(this).data('target'));
                target.toggleClass('collapse');
                $(this).toggleClass('open');
                target.css('display', target.hasClass('collapse') ? 'none' : 'block');
            });

            $('.toggle-parent').on('change', function() {
                const target = $('#' + $(this).next().next().data('target'));
                target.find('input[type="checkbox"]').prop('checked', this.checked);
            });

            // Slider for average time
            const minRange = $('#min-range');
            const maxRange = $('#max-range');
            const minLabel = $('#min-label');
            const maxLabel = $('#max-label');

            function updateSlider() {
                let minValue = parseInt(minRange.val());
                let maxValue = parseInt(maxRange.val());

                if (maxValue - minValue < 10) {
                    if (minValue > maxValue - 10) minRange.val(maxValue - 10);
                    else maxRange.val(minValue + 10);
                }

                minValue = parseInt(minRange.val());
                maxValue = parseInt(maxRange.val());

                minLabel.text(`${Math.floor(minValue / 60)}m ${minValue % 60}s`);
                maxLabel.text(`${Math.floor(maxValue / 60)}m ${maxValue % 60}s`);
            }

            minRange.on('input', updateSlider);
            maxRange.on('input', updateSlider);
            updateSlider();

            // Checkbox selection
            function toggleDeleteButton() {
                $('.delete-btn').toggleClass('d-none', $('.row-checkbox:checked').length === 0);
            }

            $(document).on('change', '.row-checkbox', function() {
                $(this).closest('tr').toggleClass('selected', this.checked);
                $(this).closest('tr').css('background-color', this.checked ? '#F1E9F0' : '');
                toggleDeleteButton();
            });

            $('#selectAll').on('change', function() {
                $('.row-checkbox').prop('checked', this.checked).closest('tr').toggleClass('selected', this.checked);
                $('.row-checkbox').each(function() {
                    $(this).closest('tr').css('background-color', this.checked ? '#F1E9F0' : '');
                });
                toggleDeleteButton();
            });

            // Chapter modal handling
            $('.sat_2').on('change', function() {
                $('.sat_type_2').removeClass('d-none');
                $('.sat_type_1').addClass('d-none');
            });

            $('.sat_1').on('change', function() {
                $('.sat_type_1').removeClass('d-none');
                $('.sat_type_2').addClass('d-none');
            });

            $(document).on('input change', '.no_of_chapters, .duration', calculateTotalSectionValues);
            $(document).on('change', 'input[name="section"]', section);
            $(document).on('click', '.save-chapter', store);
            $(document).on('click', '.chapter-delete', destroy);
            $(document).on('change', '.toggle-status', updateState);
            $(document).on('click', '.edit-btn', show);
            $(document).on('click', '.create-button', function() {
                $('.save-chapter').removeClass('d-none');
                $('.edit-chapter').addClass('d-none');
                resetData();
            });

            $('.edit-chapter').on('click', function(e) {
                e.preventDefault();
                $('#confirmationModal').modal('show');
            });

            $(document).on('click', '#proceedBtn', function(e) {
                let chapterId = $('.edit-chapter').data('id');
                update(chapterId, e);
            });

            $(document).on('click', '.openDetailModal', openDetailModal);
            $(document).on('click', '.move-ranking', moveRanking);
            $(document).on('click', '.update-ranking', updateRankingModal);

            // Datatable initialization
            let currentPage = 1;
            let perPage = $('#rowsPerPage').val();
            fetchChapters(currentPage, perPage);

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                if (page) {
                    currentPage = page;
                    fetchChapters(currentPage, perPage);
                }
            });

            $('#rowsPerPage').on('change', function() {
                perPage = $(this).val();
                fetchChapters(1, perPage);
            });

            let searchTimeout;
            $('.search_input').on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    fetchChapters(1, $('#rowsPerPage').val());
                }, 300);
            });

            $('.apply-filter-btn').on('click', function() {
                fetchChapters(1, $('#rowsPerPage').val());
            });

            $('.reset-filter').on('click', function() {
                $('.search_input').val('');
                $('input[name="crated_start_at"]').val('');
                $('input[name="crated_end_at"]').val('');
                $('input[name="status"][value="All"]').prop('checked', true);
                $('.filter-group input:checkbox').prop('checked', false);
                $('.custom-checkbox input:checkbox').prop('checked', false);
                minRange.val(1);
                maxRange.val(120);
                updateSlider();
                fetchChapters(1, $('#rowsPerPage').val());
            });
        });

        function section() {
            var sectionValue = $('input[name="section"]:checked').val();
            $('.section_part').addClass('d-none');
            for (let i = 1; i <= sectionValue; i++) {
                $('.section_div_' + i).removeClass('d-none');
            }
            calculateTotalSectionValues();
        }

        function calculateTotalSectionValues() {
            let totalChapters = 0;
            let totalDuration = 0;

            $('.section_part:not(.d-none)').each(function() {
                const no_of_chapters = parseInt($(this).find('input[name="no_of_questions"]').val()) || 0;
                const duration = parseInt($(this).find('input[name="duration"]').val()) || 0;
                totalChapters += no_of_chapters;
                totalDuration += duration;
            });

            $('#total_questions').val(totalChapters);
            $('#total_duration').val(totalDuration);
        }

        function store(e) {
            e.preventDefault();
            $.ajax({
                url: '/api/chapters',
                type: 'POST',
                data: getFormData(),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', 'Chapter created successfully!', 'success').then(() => {
                            window.location.href = response.redirect;
                        });
                    } else {
                        Swal.fire('Error', 'Failed to create chapter!', 'error');
                    }
                },
                error: function(error) {
                    let errors = error.responseJSON.errors;
                    let errorMessage = errors ? Object.keys(errors).map(field => `${field.replace('_', ' ')}: ${errors[field].join(', ')}`).join('\n') : 'An unexpected error occurred.';
                    Swal.fire('Validation Error', errorMessage, 'error');
                }
            });
        }

        function fetchChapters(page = 1, perPage = 10) {
            let filters = {
                search: $('.search_input').val(),
                difficulty: $('.difficulty:checked').map((_, el) => el.value).get(),
                crated_start_at: $('input[name="crated_start_at"]').val(),
                crated_end_at: $('input[name="crated_end_at"]').val(),
                status: $('input[name="status"]:checked').val(),
                audience: $('input[name="audience[]"]:checked').map((_, el) => el.value).get(),
                sat_type: $('input[name="sat_type[]"]:checked').map((_, el) => el.value).get(),
                created_by: $('.created_by:checked').map((_, el) => el.value).get(),
                average_time: {
                    min: $('#min-range').val(),
                    max: $('#max-range').val()
                }
            };

            $.ajax({
                url: `/api/ranking?page=${page}&per_page=${perPage}`,
                type: 'GET',
                data: filters,
                success: function(response) {
                    let chapterNullList = $('#chapterNullList');
                    let chapterList = $('#chapterList');
                    let tableBody = $('#chapter-table-body');
                    let maxChapterCount = response.total;

                    $('#max-chapter-count').text(maxChapterCount);

                    if (response.data.length === 0) {
                        if (page === 1 && Object.values(filters).every(val => !val || (Array.isArray(val) && !val.length))) {
                            chapterNullList.removeClass('d-none');
                            chapterList.addClass('d-none');
                        } else {
                            chapterNullList.addClass('d-none');
                            chapterList.removeClass('d-none');
                            tableBody.html('<tr><td colspan="11" class="text-center">No chapters found.</td></tr>');
                        }
                    } else {
                        chapterNullList.addClass('d-none');
                        chapterList.removeClass('d-none');

                        let rows = '';
                        $.each(response.data, function(index, chapter) {
                            let statusChecked = chapter.status === 'active' ? 'checked' : '';

                            rows += `<tr>
                                <td><input type="checkbox" class="row-checkbox chapter-row" value="${chapter.uuid}"></td>
                                <td>Fundamentals of Algebra: Variables & Expressions</td>
                                <td>High School</td>
                                <td>Verbal</td>
                                <td>22 Jan, 25 Admin</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-status" data-id="${chapter.id}" ${statusChecked}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <button data-uuid="f120efeb-1bb6-436c-90cc-7c467469f314" class="btn btn-sm edit-chapter-btn" data-toggle="modal" data-target="#chapterEditModelCenter">
                                        <i class="far fa-edit"></i> Edit
                                    </button>
                                </td>
                            </tr>`;
                        });
                        tableBody.html(rows);
                        updatePagination(response, page);
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Error fetching chapters.', 'error');
                }
            });
        }

        function updatePagination(response, currentPage) {
            let totalResults = response.total;
            let perPage = response.per_page;
            let totalPages = response.last_page;
            let start = response.from || 0;
            let end = response.to || 0;

            $('#pagination-info').text(`Showing ${start}-${end} out of ${totalResults} results`);
            $('#total-chapters').text(`${totalResults} Chapters`);

            let paginationHtml = `
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="1">«</a>
                </li>
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage - 1}">‹</a>
                </li>
            `;

            if (currentPage > 2) {
                paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
                paginationHtml += `<li class="page-item disabled"><a class="page-link" href="#">...</a></li>`;
            }

            for (let i = Math.max(1, currentPage - 1); i <= Math.min(totalPages, currentPage + 1); i++) {
                paginationHtml += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>`;
            }

            if (currentPage < totalPages - 1) {
                paginationHtml += `<li class="page-item disabled"><a class="page-link" href="#">...</a></li>`;
                paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a></li>`;
            }

            paginationHtml += `
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage + 1}">›</a>
                </li>
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${totalPages}">»</a>
                </li>
            `;

            $('#pagination-links').html(paginationHtml);
        }

        function formatDate(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
        }

        function updateState() {
            let chapterId = $(this).data('id');
            let newStatus = $(this).is(':checked') ? 'active' : 'inactive';

            $.ajax({
                url: `/api/chapters/${chapterId}/update-status`,
                type: 'PATCH',
                data: { status: newStatus },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', 'Status updated successfully!', 'success');
                    } else {
                        Swal.fire('Error', 'Failed to update status.', 'error');
                        $(this).prop('checked', !$(this).is(':checked'));
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Something went wrong!', 'error');
                    $(this).prop('checked', !$(this).is(':checked'));
                }
            });
        }

        function destroy() {
            let selectedChapters = $('.row-checkbox:checked').map(function() { return $(this).val(); }).get();
            if (!selectedChapters.length) {
                Swal.fire('Warning', 'Please select at least one chapter.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/api/chapter-delete',
                        type: 'POST',
                        data: { chapters: selectedChapters, _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            Swal.fire('Deleted!', 'Chapters deleted successfully.', 'success');
                            fetchChapters(1);
                        },
                        error: function() {
                            Swal.fire('Error', 'Failed to delete chapters.', 'error');
                        }
                    });
                }
            });
        }

        function update(chapterId, e) {
            e.preventDefault();
            $.ajax({
                url: `/api/chapters/${chapterId}`,
                method: 'PATCH',
                data: getFormData(),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', 'Chapter updated successfully!', 'success').then(() => {
                            window.location.href = response.redirect;
                        });
                    } else {
                        Swal.fire('Error', 'Failed to update the chapter!', 'error');
                    }
                },
                error: function(error) {
                    let errors = error.responseJSON.errors;
                    let errorMessage = errors ? Object.keys(errors).map(field => `${field.replace('_', ' ')}: ${errors[field].join(', ')}`).join('\n') : 'An unexpected error occurred.';
                    Swal.fire('Validation Error', errorMessage, 'error');
                }
            });
        }

        function getFormData() {
            let formData = {
                title: $('#title').val(),
                audience: $('input[name="audience"]:checked').val(),
                section: parseInt($('input[name="section"]:checked').val()) || null,
                section_details: [],
                total_questions: 0,
                total_duration: 0
            };

            let totalQuestions = 0, totalDuration = 0;

            $('.section_part:not(.d-none)').each(function(index) {
                let $inputs = $(this).find('input');
                let no_of_questions = parseInt($inputs.filter('[name="no_of_questions"]').val()) || 0;
                let duration = parseInt($inputs.filter('[name="duration"]').val()) || 0;

                formData.section_details.push({
                    section_type: $inputs.filter(`[name="sat_type_section_${index + 1}"]:checked`).val(),
                    chapter_name: $inputs.filter('[name="chapter_name"]').val(),
                    section_id: $(this).attr('section-id'),
                    section_order: index + 1,
                    no_of_questions,
                    duration
                });

                totalQuestions += no_of_questions;
                totalDuration += duration;
            });

            formData.total_questions = totalQuestions;
            formData.total_duration = totalDuration;

            return formData;
        }

        function resetData() {
            $('#chapterpleModalLongTitle').text('Create Chapter');
            $('#chapterModal input[type="text"]').val('');
            $('input[name="audience"]').prop('checked', false);
            $('input[name="section"]').prop('checked', false);
            $('.section_part input[type="radio"]').prop('checked', false);
            $('.section_part').attr('section-id', '').addClass('d-none');
            $('.section_part input[type="text"]').val('');
            $('#chapterModal').modal('show');
        }

        function openDetailModal() {
            let chapterId = $(this).data('id');
            $('.update-ranking').data('id', chapterId);
            $('#ranking-input').val('');
            $('#detailModalCenter').modal('show');
        }
    </script>
    @endpush
</x-backend.layouts.master>
