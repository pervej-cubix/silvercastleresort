@extends('web.main')

@section('content')

<section id="diningSection" style="padding-top: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto">
                <h3>Payment Method:</h3>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Pay Online (VISA/Master/Amex/Nexus Card, bKash, Rocket etc or IB/Wallet)
                    </label>
                </div>
                <img style="width: 150px;" src="{{asset('/')}}assets/web/images/ssllogo.png" alt="">
                <hr class="mt-5">
                <h3>Reservation:</h3>

                <form action="" method="">
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Room/Suite Type </label>
                        <div class="col-sm-9">
                            <select name="roomType" id="" class="form-select">
                                <option value="">Deluxe twin</option>
                                <option value="">luxury twin</option>
                                <option value="">Swimming twin</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <!-- No. of Rooms -->
                        <div class="col-md-4">
                            <div class="mb-3 row">
                                <label for="numRooms" class="col-sm-4 col-form-label">No. of Rooms*</label>
                                <div class="col-sm-8">
                                    <input type="number" name="numRooms" class="form-control" id="numRooms" min="1"
                                        placeholder="1">
                                </div>
                            </div>
                        </div>

                        <!-- No. of Adults -->
                        <div class="col-md-4">
                            <div class="mb-3 row">
                                <label for="numAdults" class="col-sm-4 col-form-label">No. of Adults</label>
                                <div class="col-sm-8">
                                    <input type="number" name="numAdults" class="form-control" id="numAdults" min="1"
                                        placeholder="1">
                                </div>
                            </div>
                        </div>

                        <!-- No. of Children -->
                        <div class="col-md-4">
                            <div class="mb-3 row">
                                <label for="numChildren" class="col-sm-4 col-form-label">No. of Children</label>
                                <div class="col-sm-8">
                                    <input type="number" name="numChildren" class="form-control" id="numChildren"
                                        min="0" placeholder="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Check-in and Check-out date fields -->
                    <div class="row">
                        <!-- Check-in Date -->
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label for="checkinDate" class="col-sm-4 col-form-label">Check-in Date</label>
                                <div class="col-sm-8">
                                    <input type="date" name="checkinDate" class="form-control" id="checkinDate">
                                </div>
                            </div>
                        </div>

                        <!-- Check-out Date -->
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label for="checkoutDate" class="col-sm-4 col-form-label">Check-out Date</label>
                                <div class="col-sm-8">
                                    <input type="date" name="checkoutDate" class="form-control" id="checkoutDate">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4 mb-4">
                    <h3>Guest Information:</h3>
                    <div class="mb-3 row">
                        <label for="guestName" class="col-sm-2 col-form-label">Guest Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="guestName" class="form-control" id="guestName" required />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="guestEmail" class="col-sm-2 col-form-label">Guest Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="guestEmail" class="form-control" id="guestEmail" required />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="tel" name="phone" class="form-control" id="phone" required />
                        </div>
                    </div>

                    <!-- Currency and Amount Field -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3 row">
                                <label for="currency" class="col-sm-4 col-form-label">Currency/Amount</label>
                                <div class="col-sm-8">
                                    <input type="text" name="currency" class="form-control" id="currency" required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3 row">

                                <div class="col-sm-12">
                                    <select class="form-select" name="amount" id="amount" required>
                                        <option value="">Select Amount</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3 row">
                                <label for="checkinDate" class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <input type="text" name="address" class="form-control" id="address" required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3 row">

                                <div class="col-sm-12">
                                    <input type="text" name="postacode" class="form-control" id="postcode" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 row">
                            <label for="country" class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">
                                <select name="country" class="form-select" id="address" required />
                                <option value="">Bangladesh</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="phone" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                            <input type="tel" name="city" class="form-control" id="cuty" required />
                        </div>
                    </div>


                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            By clicking Proceed, you will agree to our Terms & Condition
                        </label>
                    </div>
                    <hr class="mt-5">

                    <button type="button" class="btn btn-warning">Back</button>
                    <button type="button" class="btn btn-success float-end" style="background-color: #607978;">Process
                        pay</button>

                </form>
            </div>
        </div>
    </div>
</section>


@endsection