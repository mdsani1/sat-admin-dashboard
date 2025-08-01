<x-backend.layouts.student-master>
<div class="my-4">
    <header class="header">
        <div class="d-flex align-items-center flex-wrap gap-3 w-100">
            <ul class="nav nav-pills custom-main-tabs me-auto" id="mainTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="courses-tab" data-toggle="tab" data-target="#courses" type="button" role="tab" aria-controls="courses" aria-selected="true">Courses</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="video-lessons-tab" data-toggle="tab" data-target="#video-lessons" type="button" role="tab" aria-controls="video-lessons" aria-selected="false">Video lessons</button>
                </li>
            </ul>
        </div>
    </header>

    <div class="tab-content" id="mainTabContent">
        <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
            <div class="d-flex justify-content-end flex-wrap gap-2">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" class="course-search" placeholder="Search Courses..." id="courseSearchInput">
                </div>
                <ul class="nav nav-pills custom-filter-tabs" id="courseFilterTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-courses-tab" data-toggle="tab" data-target="#all-courses" type="button" role="tab" aria-controls="all-courses" aria-selected="true">All courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-toggle="tab" data-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Completed</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="incomplete-tab" data-toggle="tab" data-target="#incomplete" type="button" role="tab" aria-controls="incomplete" aria-selected="false">Incomplete</button>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="courseFilterTabContent">
                <div class="tab-pane fade show active" id="all-courses" role="tabpanel" aria-labelledby="all-courses-tab">
                    <h2 class="section-title mb-2">All Courses</h2>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 course-grid" id="all-courses-grid">
                        @foreach ($allCourses as $allcourse)
                        <div class="col-md-3 mb-4">
                            <div class="card course-card h-100">
                                <img src="{{ asset('storage/'.$allcourse->thumbnail) }}" class="card-img-top course-image" alt="Course Image">
                                <div class="card-body d-flex flex-column">
                                    <div class="course-meta">
                                        <ul class="d-flex" style="padding-left: 17px; margin-bottom: 0px;">
                                            <li>{{ $allcourse->audience }}</li>
                                            <li style="margin-left:28px">{{ $allcourse->total_lesson }} Lessons</li>
                                        </ul>
                                    </div>
                                    <h5 class="card-title course-title">{{ $allcourse->title }}</h5>
                                    <p class="card-text course-description">{{ $allcourse->description }}</p>
                                    <a href="{{ route('student.course.detail', $allcourse->id) }}" class="btn view-course-btn mt-auto">View Course</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <h2 class="section-title mb-2">Completed</h2>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 course-grid" id="completed-grid">
                        @foreach ($completeCourses as $completeCourse)
                        <div class="col-md-3 mb-4">
                            <div class="card course-card h-100">
                                <img src="{{ asset('storage/'.$completeCourse->thumbnail) }}" class="card-img-top course-image" alt="Course Image">
                                <div class="card-body d-flex flex-column">
                                    <div class="course-meta">
                                        <ul class="d-flex" style="padding-left: 17px; margin-bottom: 0px;">
                                            <li>{{ $completeCourse->audience }}</li>
                                            <li style="margin-left:28px">{{ $completeCourse->total_lesson }} Lessons</li>
                                        </ul>
                                    </div>
                                    <h5 class="card-title course-title">{{ $completeCourse->title }}</h5>
                                    <p class="card-text course-description">{{ $completeCourse->description }}</p>
                                    <a href="{{ route('student.course.detail', $completeCourse->id) }}" class="btn view-course-btn mt-auto">View Course</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="incomplete" role="tabpanel" aria-labelledby="incomplete-tab">
                    <h2 class="section-title mb-2">Incomplete</h2>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 course-grid" id="incomplete-grid">
                        @foreach ($incompleteCourses as $incompleteCourse)
                        <div class="col-md-3 mb-4">
                            <div class="card course-card h-100">
                                <img src="{{ asset('storage/'.$incompleteCourse->thumbnail) }}" class="card-img-top course-image" alt="Course Image">
                                <div class="card-body d-flex flex-column">
                                    <div class="course-meta">
                                        <ul class="d-flex" style="padding-left: 17px; margin-bottom: 0px;">
                                            <li>{{ $incompleteCourse->audience }}</li>
                                            <li style="margin-left:28px">{{ $incompleteCourse->total_lesson }} Lessons</li>
                                        </ul>
                                    </div>
                                    <h5 class="card-title course-title">{{ $incompleteCourse->title }}</h5>
                                    <p class="card-text course-description">{{ $incompleteCourse->description }}</p>
                                    <a href="{{ route('student.course.detail', $incompleteCourse->id) }}" class="btn view-course-btn mt-auto">View Course</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="video-lessons" role="tabpanel" aria-labelledby="video-lessons-tab">
            <div class="d-flex justify-content-end flex-wrap gap-2">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search Lessons" id="lessonSearchInput">
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 course-grid mt-4" id="lessons-grid">
                @foreach ($lessons as $lesson)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('student.video.lesson.details', $lesson->uuid) }}">
                        <div class="card lesson-card h-100">
                            <div class="video-thumbnail-container">
                                <video class="card-img-top course-image video-thumbnail" controlsList="nodownload" disablePictureInPicture preload="metadata" onloadeddata="this.currentTime=0;" muted>
                                    <source src="{{ asset('storage/' . $lesson->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title course-title">{{ $lesson->title }}</h5>
                                <p class="card-text course-description pb-0 mb-0">{{ $lesson->description }}</p>
                                <div class="course-meta">
                                    <ul class="d-flex" style="padding-left: 17px; margin-bottom: 0px;">
                                        <li>{{ $lesson->audience }}</li>
                                        <li style="margin-left:28px">Duration: {{ $lesson->total_length }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" href="{{ asset('css/student-course.css') }}">
@endpush

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const courseSearchInput = document.getElementById('courseSearchInput');
    const allCoursesGrid = document.getElementById('all-courses-grid');
    const completedGrid = document.getElementById('completed-grid');
    const incompleteGrid = document.getElementById('incomplete-grid');

    // Function to render courses
    function renderCourses(courses, container) {
        container.innerHTML = '';
        if (courses.length === 0) {
            container.innerHTML = '<p class="text-muted text-center mt-5">No courses found.</p>';
            return;
        }
        courses.forEach(course => {
            const courseHtml = `
                <div class="col-md-3 mb-4">
                    <div class="card course-card h-100">
                        <img src="/storage/${course.thumbnail}" class="card-img-top course-image" alt="Course Image">
                        <div class="card-body d-flex flex-column">
                            <div class="course-meta">
                                <ul class="d-flex" style="padding-left: 17px; margin-bottom: 0px;">
                                    <li>${course.audience}</li>
                                    <li style="margin-left:28px">${course.total_lesson} Lessons</li>
                                </ul>
                            </div>
                            <h5 class="card-title course-title">${course.title}</h5>
                            <p class="card-text course-description">${course.description}</p>
                            <a href="/student/course/detail/${course.id}" class="btn view-course-btn mt-auto">View Course</a>
                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', courseHtml);
        });
    }

    // Debounce function to limit API calls
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Handle course search
    courseSearchInput.addEventListener('input', debounce(function (event) {
        const searchQuery = event.target.value ? event.target.value.trim() : '';
        fetch(`/api/courses/search?search=${encodeURIComponent(searchQuery)}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => response.json())
        .then(data => {
            renderCourses(data.allCourses, allCoursesGrid);
            renderCourses(data.completeCourses, completedGrid);
            renderCourses(data.incompleteCourses, incompleteGrid);
        })
        .catch(error => {
            console.error('Error fetching search results:', error);
        });
    }, 300)); // 300ms debounce delay
});
</script>
@endpush
</x-backend.layouts.student-master>