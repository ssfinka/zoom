@extends('layout.user')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
/>
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

.accordion {
    background-color: white;
    color: rgba(0, 0, 0, 0.8);
    cursor: pointer;
    font-size: 1rem;
    width: 100%;
    padding: 1.5rem 2rem;
    border: none;
    outline: none;
    transition: 0.4s;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
}

.accordion i {
    font-size: 1.2rem;
}

.accordion .icons {
    display: flex;
    gap: 20px;
    position: relative;
}

.accordion.active {
    background-color: white;
}

.accordion:hover {
    background-color: #f1f7f5;
}

.pannel {
    padding: 0 1.5rem 1.5rem 1.5rem;
    background-color: #D9E6FF;
    overflow: hidden;
    display: none;
}

.pannel p {
    color: rgba(0, 0, 0, 0.7);
    font-size: 1rem;
    line-height: 1.4;
}

.faq {
    border: 1px solid rgba(0, 0, 0, 0.2);
    margin: 5px 0;
}

.faq.active {
    border: none;
}

.icon-edit {
    color: #4CAF50; /* Green color for Edit */
    cursor: pointer;
}

.icon-delete {
    color: #F44336; /* Red color for Delete */
    cursor: pointer;
}

</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h3 class="card-title">Daftar FAQ User</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($faqs as $faq)
                            <div class="faq">
                                <button class="accordion">
                                    {{ $faq->question }}
                                    <span class="icons">
                                        <i class="fa-solid fa-chevron-down icon-dropdown" onclick="toggleDropdown(event)"></i>
                                    </span>
                                </button>
                                <div class="pannel">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function toggleDropdown(event) {
    event.stopPropagation();
    var dropdown = event.target.nextElementSibling;
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';

    document.addEventListener('click', function hideDropdown(event) {
        if (!event.target.closest('.icons')) {
            dropdown.style.display = 'none';
            document.removeEventListener('click', hideDropdown);
        }
    });
}

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        this.parentElement.classList.toggle("active");

        var pannel = this.nextElementSibling;

        if (pannel.style.display === "block") {
            pannel.style.display = "none";
        } else {
            pannel.style.display = "block";
        }
    });
}
</script>

@endsection
