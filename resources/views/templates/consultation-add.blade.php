<div class="my-grid-container">
    <div class="my-grid-item">
        <input id="add-Name" class="text-input-fields" value="{{session('user')}}" type="text"  name="Name" readonly  required="required" placeholder="Name" >
    </div>

    <div class="my-grid-item">
        <input id="add-Contact" class="text-input-fields" value="{{session('contact')}}" type="text"  name="Contact" readonly required="required" placeholder="Contact" >
    </div>
    <div class="my-grid-item">
        <input id="add-Age" class="text-input-fields" type="text" value="{{session('age')}}"  name="Age"  required="required" placeholder="Age"  >
    </div>

    <div class="my-grid-item">
        <input id="add-Area" class="text-input-fields" value="{{session('area')}}" type="text"  name="Area" readonly placeholder="Area" >
    </div>

    <div class="my-grid-item">
        <input id="add-Service" class="text-input-fields" type="text"  name="Service" autocomplete="off" required="required" placeholder="Service">
    </div>

    <div class="my-grid-item">
        <input id="add-Fee" class="text-input-fields" type="number"  name="Fee" autocomplete="off" required="required" placeholder="Fee">
    </div>

    <div class="my-grid-item">
        <input id="add-Consultation" class="text-input-fields" type="text"  name="Consultation" autocomplete="off" required="required" placeholder="Consultation">
    </div>

    <input id="username" class="text-input-fields" type="hidden"  name="UserId" autocomplete="off" required="required" value="{{session('id')}}">

    <div class="my-grid-item">
        <button type="submit"   class="btn btn-primary">Submit</button>
    </div>
</div>

