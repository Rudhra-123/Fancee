<div class="second-el d--none">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-4 text-capitalize">{{ translate('create_an_account') }}</h3>
                        <div class="border p-3 p-xl-4 rounded">
                            <h4 class="mb-3 text-capitalize">{{ translate('vendor_information') }}</h4>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label class="mb-2 text-capitalize" for="f_name">{{ translate('first_name') }} <span class="text-danger">*</span></label>
                                        <input class="form-control @error('f_name') is-invalid @enderror" type="text" name="f_name" placeholder="{{ translate('ex').': John' }}" value="{{ old('f_name') }}" required>
                                        @error('f_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="mb-2 text-capitalize" for="l_name">{{ translate('last_name') }} <span class="text-danger">*</span></label>
                                        <input class="form-control @error('l_name') is-invalid @enderror" type="text" name="l_name" placeholder="{{ translate('ex').': Doe' }}" value="{{ old('l_name') }}" required>
                                        @error('l_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column gap-3 align-items-center">
                                        <div class="upload-file">
                                            <input type="file" class="upload-file__input @error('image') is-invalid @enderror" name="image" accept="image/*" required>
                                            <div class="upload-file__img">
                                                <div class="temp-img-box">
                                                    <div class="d-flex align-items-center flex-column gap-2">
                                                        <i class="bi bi-upload fs-30"></i>
                                                        <div class="fs-12 text-muted text-capitalize">{{ translate('upload_file') }}</div>
                                                    </div>
                                                </div>
                                                <img src="#" class="dark-support img-fit-contain border" alt="" hidden>
                                            </div>
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="d-flex flex-column gap-1 upload-img-content text-center">
                                            <h6 class="text-uppercase mb-1">{{ translate('vendor_image') }}</h6>
                                            <div class="text-muted text-capitalize">{{ translate('image_ratio').' '.'1:1' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border p-3 p-xl-4 rounded mt-4">
                            <h4 class="mb-3 text-capitalize">{{ translate('shop_information') }}</h4>
                            <div class="form-group mb-4">
                                <label class="mb-2 text-capitalize" for="store_name">{{ translate('store_name') }} <span class="text-danger">*</span></label>
                                <input class="form-control @error('shop_name') is-invalid @enderror" type="text" name="shop_name" placeholder="{{ translate('ex').': XYZ store' }}" value="{{ old('shop_name') }}" required>
                                @error('shop_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="mb-2 text-capitalize" for="store_address">{{ translate('store_address') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('shop_address') is-invalid @enderror" name="shop_address" rows="4" placeholder="{{ translate('store_address') }}" required>{{ old('shop_address') }}</textarea>
                                @error('shop_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="border p-3 p-xl-4 rounded mb-4">
                                <div class="d-flex flex-column gap-3 align-items-center">
                                    <div class="upload-file">
                                        <input type="file" class="upload-file__input @error('logo') is-invalid @enderror" name="logo" accept="image/*" required>
                                        <div class="upload-file__img">
                                            <div class="temp-img-box">
                                                <div class="d-flex align-items-center flex-column gap-2">
                                                    <i class="bi bi-upload fs-30"></i>
                                                    <div class="fs-12 text-muted text-capitalize">{{ translate('upload_file') }}</div>
                                                </div>
                                            </div>
                                            <img src="#" class="dark-support img-fit-contain border" alt="" hidden>
                                        </div>
                                        @error('logo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="d-flex flex-column gap-1 upload-img-content text-center">
                                        <h6 class="text-uppercase mb-1">{{ translate('store_image') }}</h6>
                                        <div class="text-muted text-capitalize">{{ translate('image_ratio').' '.'1:1' }}</div>
                                        <div class="text-muted text-capitalize">{{ translate('Image Size : Max 2 MB') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border p-3 p-xl-4 rounded">
                                <div class="d-flex flex-column gap-3 align-items-center">
                                    <div class="upload-file">
                                        <input type="file" class="upload-file__input @error('banner') is-invalid @enderror" name="banner" accept="image/*" required>
                                        <div class="upload-file__img style--two">
                                            <div class="temp-img-box">
                                                <div class="d-flex align-items-center flex-column gap-2">
                                                    <i class="bi bi-upload fs-30"></i>
                                                    <div class="fs-12 text-muted text-capitalize">{{ translate('upload_file') }}</div>
                                                </div>
                                            </div>
                                            <img src="#" class="dark-support img-fit-contain border" alt="" hidden>
                                        </div>
                                        @error('banner')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="d-flex flex-column gap-1 upload-img-content text-center">
                                        <h6 class="text-uppercase mb-1">{{ translate('store_banner') }}</h6>
                                        <div class="text-muted text-capitalize">{{ translate('image_ratio').' '.'1:1' }}</div>
                                        <div class="text-muted text-capitalize">{{ translate('Image Size : Max 2 MB') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-3 p-xl-4 rounded">
                                <div class="d-flex flex-column gap-3 align-items-center">
                                    <div class="upload-file">
                                        <input type="file" class="upload-file__input @error('bottom_banner') is-invalid @enderror" name="bottom_banner" accept="image/*" required>
                                        <div class="upload-file__img style--two">
                                            <div class="temp-img-box">
                                                <div class="d-flex align-items-center flex-column gap-2">
                                                    <i class="bi bi-upload fs-30"></i>
                                                    <div class="fs-12 text-muted text-capitalize">{{ translate('upload_file') }}</div>
                                                </div>
                                            </div>
                                            <img src="#" class="dark-support img-fit-contain border" alt="" hidden>
                                        </div>
                                        @error('bottom_banner')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="d-flex flex-column gap-1 upload-img-content text-center">
                                        <h6 class="text-uppercase mb-1">{{ translate('store_secondary_banner') }}</h6>
                                        <div class="text-muted text-capitalize">{{ translate('image_ratio').' '.'1:1' }}</div>
                                        <div class="text-muted text-capitalize">{{ translate('Image Size : Max 2 MB') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($web_config['recaptcha']['status'] == 1)
                            <div class="col-12">
                                <div id="recaptcha-element-vendor-register" class="w-100 mt-4" data-type="image"></div>
                                <br/>
                            </div>
                        @else
                            <div class="col-12">
                                <div class="row py-2 mt-4">
                                    <div class="col-6 pr-2">
                                        <input type="text" class="form-control border __h-40 @error('default_recaptcha_id_seller_regi') is-invalid @enderror" id="default-recaptcha-id-vendor-register" name="default_recaptcha_id_seller_regi" value="" placeholder="{{ translate('enter_captcha_value') }}" autocomplete="off" required>
                                        @error('default_recaptcha_id_seller_regi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-6 input-icons mb-2 rounded bg-white">
                                        <a id="re-captcha-vendor-register" class="d-flex align-items-center align-items-center">
                                            <img src="{{ route('vendor.auth.recaptcha', ['tmp'=>1]).'?captcha_session_id=sellerRecaptchaSessionKey' }}" class="input-field rounded __h-40" alt="" id="default_recaptcha_id_regi">
                                            <i class="bi bi-arrow-repeat icon cursor-pointer p-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <label class="custom-checkbox align-items-center">
                                <input type="checkbox" class="form-check-input @error('terms-checkbox') is-invalid @enderror" id="terms-checkbox" required>
                                <span class="form-check-label">{{ translate('i_agree_with_the') }} <a href="{{ route('terms') }}" target="_blank" class="text-decoration-underline color-bs-primary-force">{{ translate('terms_&_conditions') }}</a> </span>
                                @error('terms-checkbox')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                        </div>
                        <div class="d-flex justify-content-end mt-4 mb-2 gap-2">
                            <button type="button" class="btn btn-secondary back-to-main-page">{{ translate('back') }}</button>
                            <button type="submit" class="btn btn-primary">{{ translate('submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
