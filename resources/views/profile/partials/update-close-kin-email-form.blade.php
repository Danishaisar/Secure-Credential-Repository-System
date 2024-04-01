
<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')
    
    <div>
        <label for="close_kin_email">Close Kin Email</label>
        <input type="email" id="close_kin_email" name="close_kin_email" value="{{ old('close_kin_email', auth()->user()->close_kin_email) }}">
        @error('close_kin_email')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn">Update</button>
</form>
