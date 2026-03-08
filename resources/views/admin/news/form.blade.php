@extends('layouts.admin')

@section('title', 'Editor: Corporate News')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-12 flex items-center gap-4">
        <a href="{{ route('admin.news.index') }}" class="size-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-primary transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-900">{{ isset($news) ? 'Edit News Entry' : 'Write New Article' }}</h2>
            <p class="text-slate-500 font-medium">Broadcast your corporate updates to the world.</p>
        </div>
    </div>

    <form action="{{ isset($news) ? route('admin.news.update', $news->id) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        @csrf
        @if(isset($news)) @method('PUT') @endif

        <div class="lg:col-span-2 space-y-8">
            <div class="p-10 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm space-y-8">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Article Title</label>
                    <input type="text" name="title" value="{{ $news->title ?? '' }}" placeholder="Enter a compelling headline" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none text-xl font-black text-slate-900" required>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Summary (SEO Tip: Short & Sweet)</label>
                    <textarea name="summary" rows="3" placeholder="Engagement summary for social sharing..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-medium text-slate-600">{{ $news->summary ?? '' }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Main Content</label>
                    <textarea name="content" id="content-editor" rows="15" placeholder="Tell the full story here..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-medium text-slate-600">{{ $news->content ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400">Settings</label>
                
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-400 ml-2">Slug (Auto-generated if empty)</label>
                    <input type="text" name="slug" value="{{ $news->slug ?? '' }}" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-transparent text-sm font-bold text-slate-600">
                </div>

                <div class="flex items-center gap-4 py-2">
                    <input type="checkbox" name="is_published" value="1" id="is_published" {{ (isset($news) && !$news->is_published) ? '' : 'checked' }} class="size-6 rounded-lg text-primary focus:ring-primary border-slate-200">
                    <label for="is_published" class="font-bold text-slate-600">Publish Immediately</label>
                </div>
            </div>

            <div class="p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400">Thumbnail Image</label>
                <div class="size-full aspect-video rounded-2xl bg-slate-50 border-2 border-dashed border-slate-100 flex items-center justify-center text-slate-300 relative overflow-hidden group">
                    <div id="thumbnail-preview" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        @if(isset($news) && $news->thumbnail_path)
                            <img src="{{ asset('storage/' . $news->thumbnail_path) }}" class="w-full h-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-4xl">add_photo_alternate</span>
                        @endif
                    </div>
                    <input type="file" name="thumbnail" onchange="previewThumbnail(this)" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>

            <button type="submit" class="w-full py-6 bg-primary text-white rounded-[2.5rem] font-black shadow-xl shadow-primary/20 hover:scale-[1.02] transition-all">
                Submit Article
            </button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .ck-editor__editable {
        min-height: 400px;
        background-color: #ffffff !important;
        border-radius: 0 0 1.5rem 1.5rem !important;
        border: none !important;
        padding: 3rem !important;
        font-family: 'Inter', sans-serif !important;
        color: #334155 !important; /* text-slate-700 */
    }
    /* Mirroring news.show styles */
    .ck-editor__editable h2 { font-weight: 800 !important; color: #0f172a !important; margin-top: 2em !important; }
    .ck-editor__editable p { margin-bottom: 1.5em !important; line-height: 1.75 !important; }
    .ck-editor__editable strong { color: #0f172a !important; }

    .ck-toolbar {
        background-color: #ffffff !important;
        border: none !important;
        border-bottom: 1px solid #f1f5f9 !important;
        border-radius: 1.5rem 1.5rem 0 0 !important;
        padding: 0.5rem !important;
    }
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border: none !important;
    }
    .ck.ck-editor__main>.ck-editor__editable.ck-focused {
        border: 1px solid var(--color-primary) !important;
        box-shadow: none !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    function initEditor() {
        const element = document.querySelector('#content-editor');
        if (element && typeof ClassicEditor !== 'undefined') {
            class MyCustomUploadAdapter {
                constructor(loader) {
                    this.loader = loader;
                }

                upload() {
                    return this.loader.file
                        .then(file => new Promise((resolve, reject) => {
                            this._initRequest();
                            this._initListeners(resolve, reject, file);
                            this._sendRequest(file);
                        }));
                }

                abort() {
                    if (this.xhr) {
                        this.xhr.abort();
                    }
                }

                _initRequest() {
                    const xhr = this.xhr = new XMLHttpRequest();
                    xhr.open('POST', "{{ route('admin.news.upload-image') }}", true);
                    xhr.setRequestHeader('x-csrf-token', "{{ csrf_token() }}");
                    xhr.responseType = 'json';
                }

                _initListeners(resolve, reject, file) {
                    const xhr = this.xhr;
                    const loader = this.loader;
                    const genericErrorText = `Couldn't upload file: ${file.name}.`;

                    xhr.addEventListener('error', () => reject(genericErrorText));
                    xhr.addEventListener('abort', () => reject());
                    xhr.addEventListener('load', () => {
                        const response = xhr.response;
                        if (!response || response.error) {
                            return reject(response && response.error ? response.error.message : genericErrorText);
                        }
                        resolve({
                            default: response.url
                        });
                    });

                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', evt => {
                            if (evt.lengthComputable) {
                                loader.uploadTotal = evt.total;
                                loader.uploaded = evt.loaded;
                            }
                        });
                    }
                }

                _sendRequest(file) {
                    const data = new FormData();
                    data.append('upload', file);
                    this.xhr.send(data);
                }
            }

            function MyCustomUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return new MyCustomUploadAdapter(loader);
                };
            }

            ClassicEditor
                .create(element, {
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'uploadImage', 'undo', 'redo'],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                        ]
                    }
                })
                .then(editor => {
                    // Add prose classes to mirror frontend
                    editor.ui.view.editable.element.classList.add('prose', 'prose-slate', 'prose-lg', 'max-w-none');
                })
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });
        } else {
            console.error('CKEditor or element not found, retrying in 500ms...');
            setTimeout(initEditor, 500);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initEditor);
    } else {
        initEditor();
    }

    function previewThumbnail(input) {
        const container = document.getElementById('thumbnail-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                `;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
