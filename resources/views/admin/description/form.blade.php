<input type="hidden" name="description[id]" value="{{ $description->id }}">
<div class="form-group">
    <label>Заголовок</label>
    <input type="text" name="description[heading]" class="form-control" value="{{ old('description.heading', $description->heading) }}">
    @include('admin.master.message.error', ['name' => 'description.heading'])
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Мета заголовок</label>
            <textarea type="text" name="description[meta_title]" class="form-control">{{ old('description.meta_title', $description->meta_title) }}</textarea>
            @include('admin.master.message.error', ['name' => 'description.meta_title'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Мета описание</label>
            <textarea type="text" name="description[meta_description]" class="form-control">{{ old('description.meta_description', $description->meta_description) }}</textarea>
            @include('admin.master.message.error', ['name' => 'description.meta_description'])
        </div>
    </div>
</div>
<div class="form-group">
    <label>Превью</label>
    <textarea type="text" name="description[preview]" class="form-control">{{ old('description.preview', $description->preview) }}</textarea>
    @include('admin.master.message.error', ['name' => 'description.preview'])
</div>
<div class="form-group">
    <label>Полное описание</label>
    <textarea type="text" name="description[body]" class="form-control editor">{{ old('description.body', $description->body) }}</textarea>
    @include('admin.master.message.error', ['name' => 'description.body'])
</div>
