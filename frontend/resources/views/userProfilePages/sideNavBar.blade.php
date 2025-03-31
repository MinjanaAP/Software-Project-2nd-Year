<!-- sidenav.blade.php -->
<div class="sidenav">
    <div class="row navigation-item" id="myAds">
        <div class="col-2">
            <img src="{{ URL('images/my-ads-tag.svg') }}" alt="Tag Image" class="tag-images">
        </div>
        <div class="col-8">
            <p class="main"><a href="/my/ads">My Ads</a></p>
        </div>
        <div class="col-1">
            <i class="bi bi-caret-right-fill"></i>
        </div>
        
    </div>
    <div class="row navigation-item" id="bannerAds">
        <div class="col-2">
            <img src="{{ URL('images/my-ads-tag.svg') }}" alt="Tag Image" class="tag-images">
        </div>
        <div class="col-8">
            <p class="main"><a href="/my/bannerAds">Banner Ads</a></p>
        </div>
        <div class="col-1">
            <i class="bi bi-caret-right-fill"></i>
        </div>
        
    </div>
    <div class="row navigation-item" id="terms">
        <div class="col-2">
            <img src="{{ URL('images/my-membership-tag.svg') }}" alt="Tag Image" class="tag-images">
        </div>
        <div class="col-8">
            <p class="main"><a href="/aboutUs">Terms & Conditions</a></p>
        </div>
        <div class="col-1">
            <i class="bi bi-caret-right-fill"></i>
        </div>
    </div>
    <div class="row navigation-item" id="favouriteAds">
        <div class="col-2">
            <img src="{{ URL('images/favourite-tags.svg') }}" alt="Tag Image" class="tag-images">
        </div>
        <div class="col-8">
            <p class="main"><a href="/my/favouriteAds">Favourite Ads</a></p>
        </div>
        <div class="col-1">
            <i class="bi bi-caret-right-fill"></i>
        </div>
    </div>
    <div class="row navigation-item" id="bargainAds">
        <div class="col-2">
            <img src="{{ URL('images/bargain-tags.svg') }}" alt="Tag Image" class="tag-images">
        </div>
        <div class="col-8">
            <p class="main"><a href="/my/profile/bargainAds">BargainAds</a></p>
        </div>
        <div class="col-1">
            <i class="bi bi-caret-right-fill"></i>
        </div>
    </div>
    <div class="row navigation-item" id="Notifications">
        <div class="col-2">
            <img src="{{ URL('images/envelope.svg') }}" alt="Tag Image" class="tag-images">
        </div>
        <div class="col-8">
            <p class="main"><a href="/my/profile/notifications">Notifications</a></p>
        </div>
        <div class="col-1">
            <i class="bi bi-caret-right-fill"></i>
        </div>
    </div>
    <div class="row navigation-item" id="admin">
        <div class="col-2">
            <img src="{{ URL('images/adminSupport.png') }}" alt="Tag Image" class="tag-images">
        </div>
        <div class="col-8">
            <p class="main"><a href="/my/adminSupport">Admin Support</a></p>
        </div>
        <div class="col-1">
            <i class="bi bi-caret-right-fill"></i>
        </div>
    </div>
    <div class="row navigation-item" id="setting">
        <div class="col-2">
            <img src="{{ URL('images/settings-tags.svg') }}" alt="Tag Image" class="tag-images">
        </div>
        <div class="col-8">
            <p class="main"><a href="/my/profile/edit">Setting</a></p>
        </div>
        <div class="col-1">
            <i class="bi bi-caret-right-fill"></i>
        </div>
    </div>
    <div class="row navigation-item" id="myProfile">
        <div class="col-2">
            <img src="{{ URL('images/my-profile-tags.svg') }}" alt="Tag Image" class="tag-images">
        </div>
        <div class="col-8">
            <p class="main"><button class="navigation-item-btn" onclick="getUserDetails()">My Profile</button></p>
        </div>
        <div class="col-1">
            <i class="bi bi-caret-right-fill"></i>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

    $(document).ready(function() {
        $('.toggle-btn').click(function() {
            $('.sidenav').toggleClass('active');
        });
    });

    function getUserDetails() {
        window.location.href = "/my/profile/account";

    }

</script>


