<div class="container">
    <div class="search-bar rounded p-3 p-lg-4 position-relative mt-n5 z-index-20">
        <form action="{{ $action }}" method="GET">
            <div class="row">
                <div class="col-lg-10 d-flex align-items-center form-group">
                    <input class="form-control border-0 shadow-0" type="search" name="search"
                        placeholder="What are you searching for?" />
                </div>
                <div class="col-lg-2 form-group d-grid mb-0">
                    <button class="btn btn-primary h-100" type="submit">Search </button>
                </div>
            </div>
        </form>
    </div>
</div>
