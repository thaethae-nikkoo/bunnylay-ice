@let($searchFromDate = isset($searchData['from_date']) ? $searchData['from_date'] : null)
@let($searchToDate = isset($searchData['to_date']) ? $searchData['to_date'] : null)
@let($searchSaleDate = isset($searchData['sale_date']) ? $searchData['sale_date'] : null)
@let($searchItemId = isset($searchData['item_id']) ? $searchData['item_id'] : null)
@let($searchTruckNo = isset($searchData['thai_truck_no']) ? $searchData['thai_truck_no'] : null)
@let($searchKg = isset($searchData['kg']) ? $searchData['kg'] : null)
<div class="card sec-filter mb-2" @isset($searchData) style="display: block;" @endisset>
    <form action="{{route('goodSaleSearch')}}" method="GET">
        <div class="row g-3 align-items-end">
            {{-- Date range --}}
            <div class="col-12 col-lg-6">
                <label class="form-label mb-1">ရက်စွဲ (Range)</label>
                <div class="input-group">
                    <input type="text" name="from_date" id="from_date" class="form-control" value="{{$searchFromDate}}"
                        placeholder="DD/MM/YYYY" autocomplete="off">
                    <span class="input-group-text">~</span>
                    <input type="text" name="to_date" id="to_date" class="form-control" value="{{$searchToDate}}"
                        placeholder="DD/MM/YYYY" autocomplete="off">
                </div>
            </div>

            {{-- Exact date --}}
            <div class="col-12 col-sm-6 col-lg-2">
                <label class="form-label mb-1">ရက်စွဲ</label>
                <input type="text" name="sale_date" id="sale_date" class="form-control" value="{{$searchSaleDate}}"
                    placeholder="DD/MM/YYYY" autocomplete="off">
            </div>

            {{-- Item --}}
            <div class="col-12 col-sm-6 col-lg-4 item_id_search-select">
                <label class="form-label mb-1">ကုန်အမျိုးအစား</label>
                <select name="item_id" class="form-select single-select">
                    <option value="">--ရွေးချယ်ပါ--</option>
                    @foreach ($items as $item)
                    <option value="{{ $item->item_id }}" @selected($item->item_id == $searchItemId)>
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <label class="form-label mb-1">ထိုင်းကားနံပါတ်</label>
                <input type="text" name="thai_truck_no" class="form-control" value="{{$searchTruckNo}}">
            </div>

            <div class="col-6 col-sm-3 col-lg-2">
                <label class="form-label mb-1">KG အရေအတွက်</label>
                <input type="text" name="kg" class="form-control" value="{{$searchKg}}">
            </div>

            <div class="col-12 col-sm-auto ms-sm-auto">
                <div class="d-flex gap-2 flex-column flex-sm-row">
                    <button type="submit" class="btn btn-primary w-100 w-sm-auto" title="ရှာရန်">
                        <i class="fas fa-search mr-1"></i>
                    </button>
                    <a href="{{ route('goodSaleList') }}" class="btn btn-primary w-100 w-sm-auto"
                        title="ပုံသေသို့ ပြန်ရန်">
                        <i class="fas fa-sync-alt mr-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
