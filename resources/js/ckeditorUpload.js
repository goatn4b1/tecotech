class UploadAdapter {
    constructor(loader) {
        this.loader = loader;
        this.controller = new AbortController();
    }

    async upload() {
        const file = await this.loader.file;
        const data = new FormData();
        data.append('upload', file);

        const response = await window.axios.post(route('admin.ckfinder.upload'), data, {
            signal: this.controller.signal,
            headers: { 'Content-Type': 'multipart/form-data' },
        });

        return { default: response.data.url };
    }

    abort() {
        this.controller.abort();
    }
}

export function imageUploadPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => new UploadAdapter(loader);
}

export const richEditorConfig = {
    extraPlugins: [imageUploadPlugin],
    ckfinder: {
        uploadUrl: route('admin.ckfinder.upload'),
    },
    toolbar: [
        'heading',
        '|',
        'bold',
        'italic',
        'link',
        'bulletedList',
        'numberedList',
        'blockQuote',
        '|',
        'insertTable',
        'imageUpload',
        'undo',
        'redo',
    ],
};
