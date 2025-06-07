 <hr class="my-4" />

 <h6 class="heading-small text-muted mb-4">Meta information</h6>

 <div class="row">
     <div class="col-6">
         <div class="form-group">
             <label class="form-control-label" for="name">Meta Title</label>
             <input type="text" name="meta_title" value="{{ old('meta_title', $item->meta_title) }}"
                 class="form-control" title="meta_title" id="meta_title" placeholder="Meta Title">
             @error('meta_title')
                 <div class="invalid-div">{{ $message }}</div>
             @enderror
         </div>
     </div>
     <div class="col-6">
         <div class="form-group">
             <label class="form-control-label" for="name">Meta Keywords</label>
             <input type="text" name="meta_keyword" value="{{ old('meta_keyword', $item->meta_keyword) }}"
                 class="form-control" title="meta_keyword" id="meta_keyword" placeholder="Meta Content">
             @error('meta_keyword')
                 <div class="invalid-div">{{ $message }}</div>
             @enderror
         </div>
     </div>
 </div>


 <div class="row">
     <div class="col-12">
         <div class="form-group">
             <label class="form-control-label" for="name">Meta Content</label>
             <textarea class="form-control" name="meta_content" id="meta_content" rows="6">{{ old('meta_content', $item->meta_content) }}</textarea>

             @error('meta_content')
                 <div class="invalid-div">{{ $message }}</div>
             @enderror
         </div>
     </div>
 </div>
