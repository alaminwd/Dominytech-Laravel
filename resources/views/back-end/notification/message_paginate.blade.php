<table class="table table-hover table-data">
    <thead>
        <tr class="text-center">
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($messages as $sl=>$message )
        <tr class="text-center">
            <td>{{$sl+1}}</td>
            <td>{{$message->name}}</td>
            <td>{{$message->email}}</td>
            <td>{{substr($message->desp, 0, 25)}}..</td>
            <td>
                <div class="dropdown mb-3">
                    <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                        <svg width="6" height="26" viewBox="0 0 6 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 3C6 4.65685 4.65685 6 3 6C1.34315 6 0 4.65685 0 3C0 1.34315 1.34315 0 3 0C4.65685 0 6 1.34315 6 3Z" fill="#585858"></path>
                            <path d="M6 13C6 14.6569 4.65685 16 3 16C1.34315 16 0 14.6569 0 13C0 11.3431 1.34315 10 3 10C4.65685 10 6 11.3431 6 13Z" fill="#585858"></path>
                            <path d="M6 23C6 24.6569 4.65685 26 3 26C1.34315 26 0 24.6569 0 23C0 21.3431 1.34315 20 3 20C4.65685 20 6 21.3431 6 23Z" fill="#585858"></path>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="" class="dropdown-item">View</a>
                        <a href="" class="dropdown-item">Delete</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $messages->links() }}
