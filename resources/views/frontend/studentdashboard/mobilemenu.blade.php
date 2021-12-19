<!--MOBILE USER DASHBOARD-->
<section class="mobile-user-dashboard">
    <div class="mud-logo">

        <span class="mud-close">
            <i class="fa fa-times" id="mud-close-btn"></i>
        </span>
        <h6>{{ Auth::user()->name }}</h6>
        <div>

            <a href="{{ route('student.logout') }}">
                <i class="fa fa-sign-out"></i>
                Logout
            </a>
        </div>
    </div>

    <div class="dashboard-item py-3">

        <ul>
            <li class="">
                <a href="{{ route('student.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    Dashboard
                </a>


            <li class="">
                <a href="{{ route('student.batch.enroll') }}">
                    <i class="fa fa-building-o"></i>
                    Batch List
                </a>
            </li>
            
            <li class="">
                    <a href="{{ route('student.attendance.pending') }}">
                        <i class="fa fa-building-o"></i>
                        Pending Attendance
                    </a>
            </li>
            <li class="">
                    <a href="{{ route('student.attendance.history') }}">
                        <i class="fa fa-building-o"></i>
                         Attendance History
                    </a>
            </li>


            <li class="">
                        <a href="{{ route('student.homework.pending') }}">
                            <i class="fa fa-building-o"></i>
                            Pending Homework
                        </a>
                </li>
                <li class="">
                        <a href="{{ route('student.homework.history') }}">
                            <i class="fa fa-building-o"></i>
                             Submitted Homework
                        </a>
            </li>
            
            <li>
                <a href="{{ route('student.exam.mcq.index') }}">
                    <i class="fa fa-newspaper-o"></i>
                    Quiz Test
                </a>
            </li>
            <li>
                <a href="{{ route('student.exam.mcq.history') }}">
                    <i class="fa fa-newspaper-o"></i>
                    Quiz Test History
                </a>
            </li>

            <li>
                <a href="{{ route('student.exam.written.index') }}">
                    <i class="fa fa-newspaper-o"></i>
                    Written Exam
                </a>
            </li>
            <li>
                <a href="{{ route('student.exam.written.history') }}">
                    <i class="fa fa-newspaper-o"></i>
                    Written Exam History
                </a>
            </li>

            <li>
                <a href="{{ route('student.sheet.available') }}">
                    <i class="fa fa-database"></i>
                    Available Sheets
                </a>
            </li>
            <li>
                <a href="{{ route('student.payment.history') }}">
                    <i class="fa fa-money"></i>
                    Payment History
                </a>
            </li>    

            <li>
                <a href="{{ route('student.setting') }}">
                    <i class="fa fa-cog"></i>
                    Settings
                </a>
            </li>

            <li>
                <a href="{{ route('student.profile') }}">
                    <i class="fa fa-user"></i>
                    profile
                </a>
            </li>

            <li>
                <a href="{{ route('student.personal.information') }}">
                    <i class="fa fa-user"></i>
                    Personal Information
                </a>
            </li>

            <li>
                <a href="{{ route('student.logout') }}" title=""><i class="fa fa-sign-out"></i> Logout</a>
            </li>

        </ul>

    </div>
</section>
<!--MOBILE USER DASHBOARD-->
