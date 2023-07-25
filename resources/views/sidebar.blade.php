<ul class="nav">
    <li class="nav-item nav-profile">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            @if(Auth::user()->type == 'Admin')
              <img class="img-xs rounded-circle"  src="{{asset('images/admin.png')}}" alt="profile image">
            @else
              <img class="img-xs rounded-circle"  src="{{asset('images/user.png')}}" alt="profile image">
          @endif
            
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{Auth::user()->name}}</p>
            <div>
              <small class="designation text-muted" style="text-transform: uppercase;letter-spacing: 1px;">{{ Auth::user()->type }}</small>
              <span class="status-indicator online"></span>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li class="nav-item {{ setActive(['dashboard*']) }}"> 
      <a class="nav-link" href="{{url('/dashboard')}}">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @if(Auth::user()->type == 'Admin')
        <li class="nav-item {{ setActive(['sub_user*']) }}"> 
            <a class="nav-link" href="{{url('/sub_user')}}">
            <i class="menu-icon mdi mdi-account-box-outline"></i>
            <span class="menu-title">Sub User</span>
            </a>
        </li>
        <li class="nav-item {{ setActive(['department*', 'employee*', 'necessity*', 'available*']) }}">
          <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="menu-icon mdi mdi-content-copy"></i>
            <span class="menu-title">Master Data</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse {{ setShow(['department*', 'employee*', 'necessity*', 'available*']) }}" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link {{ setActive(['department*']) }}" href="{{route('department')}}">Department</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive(['employee*']) }}" href="{{route('employee')}}">Employee</a>
              </li>
               <li class="nav-item">
                <a class="nav-link {{ setActive(['necessity*']) }}" href="{{route('necessity')}}">Necessity</a>
              </li>
               <li class="nav-item">
                <a class="nav-link {{ setActive(['available*']) }}" href="{{route('employee_available')}}">Employee Availability</a>
              </li>
            </ul>
          </div>
        </li>
    @endif
    <li class="nav-item {{ setActive(['data*']) }}"> 
        <a class="nav-link" href="{{url('/data')}}">
        <i class="menu-icon mdi mdi-account-edit"></i>
        <span class="menu-title">Visitor Data</span>
        </a>
    </li>
    <li class="nav-item {{ setActive(['visitor*']) }}"> 
        <a class="nav-link" href="{{url('/visitor')}}">
        <i class="menu-icon mdi mdi-history"></i>
        <span class="menu-title">Visitor Log</span>
        </a>
    </li>
    @if(Auth::user()->type == 'Admin')
        <li class="nav-item {{ setActive(['report*']) }}"> 
            <a class="nav-link" href="{{url('/report')}}">
            <i class="menu-icon mdi mdi-table"></i>
            <span class="menu-title">Report</span>
            </a>
        </li>
    @endif
    
   
  </ul>