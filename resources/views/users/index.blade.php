@extends('layouts.dash')
@section('title', 'Dashboard | Users')
@section('content')
    <div class="filter-buttons">
        <div class="title">
            <h2>Users</h2>
        </div>
        <div class="btn">
            <input type="search" placeholder="Search..">
            <button id="openModalButton" class="download-button">
                <i class="fa-solid fa-plus"></i> Add a new User
            </button>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ ucfirst($user->name) }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->address }}</td>
                <td>

                        @if($user->role!='admin')
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btnsEd"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                    @endif
                    <button class="edit-button btnsEd"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            data-email="{{ $user->email }}"
                            data-role="{{ $user->role }}"
                            data-phone="{{ $user->phone_number }}"
                            data-address="{{ $user->address }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

<!-- Add User Modal -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeUserModal" onclick="hideAddUserModal()"><i class="fa-solid fa-circle-xmark"></i></span>
        <h2>Add a New User</h2>
        <form action="{{ route('users.store') }}" method="POST" id="addUserForm" class="form-body">
            @csrf
            <div class="input-box">
                <span><i class="fa-solid fa-user"></i></span>
                <input type="text" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-envelope"></i></span>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-lock"></i></span>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-role"></i></span>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-phone"></i></span>
                <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number">
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-address"></i></span>
                <input type="text" id="address" name="address" placeholder="Address">
            </div>
            <button type="submit" class="btn">Add User</button>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <span class="close" id="editCloseIcon" onclick="hideEditUserModal()"><i class="fa-solid fa-circle-xmark"></i></span>
        <h2>Edit User</h2>
        <form action="" method="POST" id="editUserForm" class="form-body">
            @csrf
            @method('PUT')
            <input type="hidden" id="editUserId" name="id">
            <div class="input-box">
                <span><i class="fa-solid fa-user"></i></span>
                <input type="text" id="editName" name="name" placeholder="Name" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-envelope"></i></span>
                <input type="email" id="editEmail" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-lock"></i></span>
                <input type="password" id="editPassword" name="password" placeholder="Password">
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-role"></i></span>
                <select id="editRole" name="role" required>
                    <option value="" disabled>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-phone"></i></span>
                <input type="text" id="editPhoneNumber" name="phone_number" placeholder="Phone Number">
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-address"></i></span>
                <input type="text" id="editAddress" name="address" placeholder="Address">
            </div>
            <button type="submit" class="btn">Update User</button>
        </form>
    </div>
</div>

<!-- JavaScript to handle modals -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the modals
        var addUserModal = document.getElementById('addUserModal');
        var editUserModal = document.getElementById('editUserModal');

        // Get the buttons that open the modals
        var addUserBtn = document.getElementById("openModalButton");

        // Get the close icons
        var addUserCloseIcon = document.getElementById("closeUserModal");
        var editUserCloseIcon = document.getElementById("editCloseIcon");

        // When the user clicks the button, open the add user modal
        addUserBtn.onclick = function() {
            addUserModal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the add user modal
        addUserCloseIcon.onclick = function() {
            addUserModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target === addUserModal) {
                addUserModal.style.display = "none";
            }
        }

        // Handle edit button click
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function() {
                var userId = this.getAttribute('data-id');
                var userName = this.getAttribute('data-name');
                var userEmail = this.getAttribute('data-email');
                var userRole = this.getAttribute('data-role');
                var userPhone = this.getAttribute('data-phone');
                var userAddress = this.getAttribute('data-address');

                // Populate the form with the user details
                document.getElementById('editUserId').value = userId;
                document.getElementById('editName').value = userName;
                document.getElementById('editEmail').value = userEmail;
                document.getElementById('editRole').value = userRole;
                document.getElementById('editPhoneNumber').value = userPhone;
                document.getElementById('editAddress').value = userAddress;

                // Set the form action to the update route
                document.getElementById('editUserForm').action = '/users/' + userId;

                // Display the modal
                editUserModal.style.display = "block";
            });
        });

        // When the user clicks on <span> (x), close the edit user modal
        editUserCloseIcon.onclick = function() {
            editUserModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target === editUserModal) {
                editUserModal.style.display = "none";
            }
        }
    });

    function hideAddUserModal() {
        document.getElementById('addUserModal').style.display = 'none';
    }

    function hideEditUserModal() {
        document.getElementById('editUserModal').style.display = 'none';
    }
</script>
