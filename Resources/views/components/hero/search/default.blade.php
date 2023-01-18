<div class="container">
    <div class="search-bar rounded p-3 p-lg-4 position-relative mt-n5 z-index-20">
        <form action="{{ $action }}" method="GET">
            <div class="row">
                <div class="col-lg-4 d-flex align-items-center form-group">
                    <input class="form-control border-0 shadow-0" type="search" name="search"
                        placeholder="What are you searching for?" />
                </div>
                <div class="col-md-6 col-lg-3 d-flex align-items-center form-group">
                    <div class="input-label-absolute input-label-absolute-right w-100">
                        <label class="label-absolute" for="location"><i class="fa fa-crosshairs"></i>
                            <div class="sr-only">City</div>
                        </label>
                        <input class="form-control border-0 shadow-0" type="text" name="location" placeholder="Location"
                            id="location" />
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex align-items-center form-group no-divider">
                    <select class="selectpicker" title="Categories" data-style="btn-form-control">
                        <option value="small">Restaurants</option>
                        <option value="medium">Hotels</option>
                        <option value="large">Cafes</option>
                        <option value="x-large">Garages</option>
                    </select>
                </div>
                <div class="col-lg-2 form-group d-grid mb-0">
                    <button class="btn btn-primary h-100" type="submit">Search </button>
                </div>
            </div>
        </form>
    </div>
</div>
