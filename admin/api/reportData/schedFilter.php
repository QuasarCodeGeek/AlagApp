<tr>
    <th></th>
    <th>
    </th>
    <th>
    </th>
    <th>  
    </th>
    <th>
        <div class="row">
            <div class="col-4">
                <label class="form-label">From</label>
                <input type="date" class="col form-control me-2" id="firstdate">
            </div>
            <div class="col-4">
            <label class="form-label">To</label>
                <input type="date" class="col form-control me-2" id="lastdate" onchange="filterSched()">
            </div>
            <div class="col-4">
            <label class="form-label">Month</label>
                <input type="month" class="col form-control me-2" id="month" onchange="filterSched()">
            </div>
        </div>
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="status" onchange="filterSched()">
            <option selected value="">-Select Status-</option>
            <option value="Pending">Pending</option>
            <option value="Accepted">Accepted</option>
            <option value="Denied">Denied</option>
            <option value="Cancelled">Cancelled</option>
            <option value="Finished">Finished</option>
        </select>
    </th>
</tr>