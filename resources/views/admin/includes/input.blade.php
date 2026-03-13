@let($name = $_resource->name ?? null)
@let($username = $_resource->username ?? null)
@let($phone = $_resource->phone ?? null)
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3 parent">
        <label for="name" class="form-label">အမည် <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="name" id="name" value="{{ old('name', $name) }}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3 parent">
        <label for="username" class="form-label">အသုံးပြုသူ၏ ID <span class="required-star">*</span></label>
        <input type="text" class="form-control shadow-none" name="username" id="username"
            value="{{ old('username', $username) }}" />
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3 parent @if(isset($_resource)) hidden @endif pw-upd">
        <label for="password" class="form-label">စကားဝှက် <span class="required-star">*</span></label>
        <div class="input-group">
            <input type="password" class="form-control shadow-none" name="password" id="password"
                value="{{ old('password') }}" />
            <span class="input-group-text pwd-open-close" id="password_eye">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 5c-7.63 0-9.93 6.62-9.95 6.68-.07.21-.07.43 0 .63.02.07 2.32 6.68 9.95 6.68s9.93-6.62 9.95-6.68c.07-.21.07-.43 0-.63C21.93 11.61 19.63 5 12 5m0 12c-5.35 0-7.42-3.84-7.93-5 .5-1.16 2.58-5 7.93-5s7.42 3.85 7.93 5c-.5 1.16-2.58 5-7.93 5">
                    </path>
                    <path
                        d="M13.5 12c-.83 0-1.5-.67-1.5-1.5 0-.6.36-1.12.87-1.35-.28-.09-.56-.15-.87-.15-1.64 0-3 1.36-3 3s1.36 3 3 3 3-1.36 3-3c0-.3-.06-.59-.15-.87-.24.51-.75.87-1.35.87">
                    </path>
                </svg>
            </span>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3 parent @if(isset($_resource)) hidden @endif pw-upd">
        <label for="confirm_password" class="form-label">စကားဝှက်အတည်ပြု <span class="required-star">*</span></label>
        <div class="input-group">
            <input type="password" class="form-control shadow-none" name="confirm_password" id="confirm_password" />
            <span class="input-group-text pwd-open-close" id="confirm_password_eye">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 5c-7.63 0-9.93 6.62-9.95 6.68-.07.21-.07.43 0 .63.02.07 2.32 6.68 9.95 6.68s9.93-6.62 9.95-6.68c.07-.21.07-.43 0-.63C21.93 11.61 19.63 5 12 5m0 12c-5.35 0-7.42-3.84-7.93-5 .5-1.16 2.58-5 7.93-5s7.42 3.85 7.93 5c-.5 1.16-2.58 5-7.93 5">
                    </path>
                    <path
                        d="M13.5 12c-.83 0-1.5-.67-1.5-1.5 0-.6.36-1.12.87-1.35-.28-.09-.56-.15-.87-.15-1.64 0-3 1.36-3 3s1.36 3 3 3 3-1.36 3-3c0-.3-.06-.59-.15-.87-.24.51-.75.87-1.35.87">
                    </path>
                </svg>
            </span>
        </div>
    </div>
    @if(isset($_resource))
    <div class="col-md-6 col-lg-4 mt-3 parent" id="pwd-btn-cont">
        <div class="form-group mt-4">
            <button class="btn btn-primary btn-md mt-1" type="button" id="update-pwd-btn">စကားဝှက်ပြောင်းလဲမည်</button>
        </div>
    </div>
    @endif
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3 parent">
        <label for="phone" class="form-label">ဖုန်းနံပါတ်</label>
        <input type="text" class="form-control shadow-none" name="phone" id="phone" value="{{ old('phone', $phone) }}" />
    </div>
    {{-- <div class="col-lg-4 col-md-6 col-sm-12 mt-3 selection">
        <label for="role" class="form-label">လုပ်ပိုင်ခွင့် <span class="required-star">*</span></label>
        <div class="role-error-element role-select custom-select">
            <select class="form-select form-control shadow-none select role single-select" name="role" id="role">
                <option value="1">အက်ထ်မင်</option>
                <option value="2">ဝန်ထမ်း</option>
            </select>
        </div>
    </div> --}}
</div>
