<form action="{{ route('basket.checkout') }}" method="get" id="profiles">
	<div class="mb-3">
			<select name="profile_id" class="form-control">
					<option value="0">{{ __('Выберите профиль') }}</option>
					@foreach($profiles as $profile)
							<option value="{{ $profile->id }}"@if($profile->id == $current) selected @endif>
									{{ $profile->title }}
							</option>
					@endforeach
			</select>
	</div>
	<div class="mb-3">
			<button type="submit" class="btn btn-primary">{{ __('Выбрать') }}</button>
	</div>
</form>