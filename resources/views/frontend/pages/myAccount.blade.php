@extends('frontend.master')
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Wellcome, {{ auth()->user()->name ?? '' }}</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Account</li>
                </ul>

                <!-- breadcrumb-list end -->



                <!-- breadcrumb-area end -->

                <!-- account area start -->
                <div class="account-dashboard pt-100px pb-100px">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <!-- Nav tabs -->
                                <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                                    <ul role="tablist" class="nav flex-column dashboard-list">
                                        <li><a href="#dashboard" data-bs-toggle="tab"
                                                class="nav-link active">Dashboard</a></li>
                                        <li> <a href="#orders" data-bs-toggle="tab" class="nav-link">Orders</a></li>
                                        {{-- <li><a href="#downloads" data-bs-toggle="tab" class="nav-link">Downloads</a>
                                        </li> --}}
                                        <li><a href="#address" data-bs-toggle="tab" class="nav-link">Addresses</a></li>
                                        <li><a href="#account-details" data-bs-toggle="tab" class="nav-link">Account
                                                details</a>
                                        </li>
                                        <li><a href="#"
                                                onclick="event.preventDefault();document.getElementById('form-logout').submit()"
                                                class="nav-link">logout</a></li>
                                    </ul>
                                    <form action="{{ route('logout') }}" method="POST" id="form-logout">@csrf</form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-9 col-lg-9">
                                <!-- Tab panes -->
                                <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                                    <div class="tab-pane fade show active" id="dashboard">
                                        <h4>Dashboard </h4>
                                        <p>From your account dashboard. you can easily check &amp; view your <a
                                                href="#">recent
                                                orders</a>, manage your <a href="#">shipping and billing addresses</a>
                                            and <a href="#">Edit your password and account details.</a></p>
                                    </div>
                                    <div class="tab-pane fade" id="orders">

                                        <h4>Orders</h4>

                                        <div class="table_page table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Order</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($bills as $bill)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $bill->created_at->format('d F, Y') }}</td>
                                                        <td><span class="success">
                                                                @if ($bill->amount->payment_status == '1')
                                                                Processing
                                                                @else
                                                                Completed
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td><i class="text-danger">Tk.</i>
                                                            {{ $bill->amount->grand_total }}
                                                            for
                                                            {{ $bill->amount->products->sum('quantity') }}
                                                            item
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('customer.viewInvoice',$bill) }}"
                                                                class="view m-2">view</a>
                                                            <a href="{{ route('customer.downloadInvoice',$bill) }}"
                                                                class="view">Download</a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center">No Data Avilable</td>
                                                    </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="downloads">
                                        <h4>Downloads</h4>
                                        <div class="table_page table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Downloads</th>
                                                        <th>Expires</th>
                                                        <th>Download</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Shopnovilla - Free Real Estate PSD Template</td>
                                                        <td>May 10, 2018</td>
                                                        <td><span class="danger">Expired</span></td>
                                                        <td><a href="#" class="view">Click Here To Download Your
                                                                File</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Organic - cit-ecommerce html template</td>
                                                        <td>Sep 11, 2018</td>
                                                        <td>Never</td>
                                                        <td><a href="#" class="view">Click Here To Download Your
                                                                File</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> --}}
                                    <div class="tab-pane" id="address">
                                        <p>The following addresses will be used on the checkout page by default.</p>
                                        <h5 class="billing-address">Last Billing address</h5>
                                        <p class="mb-2"><strong>{{ auth()->user()->name }}</strong></p>
                                        @if ($lastbill)

                                        <address>
                                            <span
                                                class="mb-1 d-inline-block"><strong>Address:</strong>{{ $lastbill->address }}</span>,
                                            <br>
                                            <span
                                                class="mb-1 d-inline-block"><strong>City:</strong>{{ getgeoname($lastbill->city) }}</span>,
                                            <br>
                                            <span class="mb-1 d-inline-block"><strong>Disctrict:</strong>
                                                {{ getgeoname($lastbill->district) }}</span>,
                                            <br>
                                            <span class="mb-1 d-inline-block"><strong>Thana:</strong>
                                                {{ getgeoname($lastbill->thana) }}</span>,
                                            <br>

                                            <span class="mb-1 d-inline-block number"><strong>ZIP:</strong>
                                                {{ $lastbill->zipcode }}</span>,
                                            <br>
                                            <span><strong>Country:</strong> Bangladesh</span>
                                        </address>
                                        @else
                                        <address>
                                            <span class="mb-1 d-inline-block"><strong>Address: </strong> You didn't buy
                                                anything from us.</span>,
                                            <br>
                                            <span>
                                        </address>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="account-details">
                                        <h3>Account details </h3>
                                        <div class="login">
                                            <div class="login_form_container">
                                                <div class="account_login_form">
                                                    <form action="{{ route('profile.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @php
                                                        $profile = auth()->user()->profile;
                                                        @endphp
                                                        <div class="input-radio">
                                                            <span class="custom-radio">
                                                                <input @if ($profile->gender == "male") checked
                                                                @endif value="" type="radio" value="male"
                                                                name="gender">
                                                                Mr.</span>
                                                            <span class="custom-radio">
                                                                <input @if ($profile->gender == "male") checked
                                                                @endif type="radio" value="female"
                                                                name="gender">
                                                                Mrs.</span>
                                                        </div> <br>
                                                        <div class="default-form-box mb-20">
                                                            <label>Name</label>
                                                            <input required value="{{ auth()->user()->name }}"
                                                                type="text" name="name">
                                                        </div>
                                                        <div class="default-form-box mb-20">
                                                            <label>Email</label>
                                                            <input required value="{{ auth()->user()->email }}"
                                                                type="text" name="email">
                                                            @error('email')
                                                            <div class=" alert alert-danger">{{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="default-form-box mb-20">
                                                            <label>Mobile No</label>
                                                            <input value="{{ $profile->mobile_no }}" type="tel"
                                                                name="mobile_no">
                                                            @error('mobile_no')
                                                            <div class=" alert alert-danger">{{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        @if (auth()->user()->registration_method == "local")
                                                        <div class="default-form-box mb-20">
                                                            <label>Password</label>
                                                            <input value="" type="password" name="password">

                                                        </div>
                                                        <div class="default-form-box mb-20">
                                                            <label>Confirm Password</label>
                                                            <input value="" type="password" name="confirmed">

                                                        </div>

                                                        @endif
                                                        <div class="default-form-box mb-20">
                                                            <i class="fas fa-map-marker-alt mr-2"></i><label
                                                                for="address">Address..</label>
                                                            <input value="{{ $profile->address }}" type="text"
                                                                class="form-control @error('address') is-invalid @enderror"
                                                                id="address"
                                                                placeholder="#12,Manik miya Avenue, Sher A bangla Nagar, Dhaka"
                                                                name="address" value="">
                                                            @error('address')
                                                            <div class=" alert alert-danger">{{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class=" text-center mb-20">
                                                            <label>Image</label>
                                                            <input type="file" class="default-form-box" name="image">
                                                        </div>

                                                        <br>
                                                        <div class="save_button mt-3">
                                                            <button class="btn" type="submit">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- account area start -->

@endsection
