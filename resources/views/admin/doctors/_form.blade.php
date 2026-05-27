<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    {{-- Kolom kiri --}}
    <div class="space-y-6">
        <div>
            <label class="font-medium">Nama Dokter</label>
            <input
                name="name"
                value="{{ old('name', $doctor->name ?? '') }}"
                class="mt-1 w-full rounded-lg border border-slate-400 bg-white px-3 py-2"
            >
        </div>

        <div>
            <label class="font-medium">No STR</label>
            <input
                name="str_number"
                value="{{ old('str_number', $doctor->str_number ?? '') }}"
                class="mt-1 w-full rounded-lg border border-slate-400 bg-white px-3 py-2"
            >
        </div>

        <div>
            <label class="font-medium">Biaya Konsultasi</label>
            <input
                type="number"
                name="consultation_fee"
                value="{{ old('consultation_fee', $doctor->consultation_fee ?? '') }}"
                class="mt-1 w-full rounded-lg border border-slate-400 bg-white px-3 py-2"
            >
        </div>

        <div>
            <label class="inline-flex items-center gap-2">
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    @checked(old('is_active', $doctor->is_active ?? true))
                    class="rounded border-slate-400 text-emerald-600"
                >
                <span>Aktif</span>
            </label>
        </div>

        <div>
            <button
                type="submit"
                class="rounded-lg bg-emerald-600 px-4 py-2 text-white hover:bg-emerald-700"
            >
                Simpan
            </button>
        </div>
    </div>

    {{-- Kolom kanan --}}
    <div class="space-y-6">
        <div>
            <label class="font-medium">Spesialisasi</label>
            <input
                name="specialization"
                value="{{ old('specialization', $doctor->specialization ?? '') }}"
                class="mt-1 w-full rounded-lg border border-slate-400 bg-white px-3 py-2"
            >
        </div>

        <div>
            <label class="font-medium">No HP</label>
            <input
                name="phone"
                value="{{ old('phone', $doctor->phone ?? '') }}"
                class="mt-1 w-full rounded-lg border border-slate-400 bg-white px-3 py-2"
            >
        </div>

        <div>
            <label class="font-medium">Foto Dokter</label>

            <label
                for="photoInput"
                class="mt-1 flex w-full cursor-pointer items-center gap-3 rounded-lg border border-slate-400 bg-white px-3 py-2 text-slate-600 hover:border-emerald-600 hover:bg-emerald-50"
            >
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M12 12V4m0 0l-4 4m4-4l4 4" />
                    </svg>
                </span>

                <span id="photoFileName">Pilih foto dokter</span>
            </label>

            <input
                id="photoInput"
                type="file"
                accept="image/*"
                class="hidden"
            >

            <input type="hidden" name="cropped_photo" id="croppedPhoto">

            @if (!empty($doctor?->photo))
                <div class="mt-3 flex items-center gap-3">
                    <img
                        src="{{ asset('storage/' . $doctor->photo) }}"
                        alt="Foto Dokter"
                        class="h-16 w-16 rounded-full border border-slate-300 object-cover"
                    >
                    <span class="text-sm text-slate-500">Foto saat ini</span>
                </div>
            @endif

            <div id="cropArea" class="mt-4 hidden">
                <p class="mb-2 text-sm text-slate-600">
                    Atur posisi foto dengan menggeser dan zoom agar wajah dokter terlihat jelas.
                </p>

                <div class="max-h-96 overflow-hidden rounded-lg border border-slate-300 bg-slate-100">
                    <img id="cropImage" class="block max-w-full" alt="Crop Foto Dokter">
                </div>

                <div class="mt-3 flex flex-wrap gap-2">
                    <button
                        type="button"
                        id="zoomInBtn"
                        class="rounded-lg bg-slate-200 px-3 py-2 hover:bg-slate-300"
                    >
                        Zoom +
                    </button>

                    <button
                        type="button"
                        id="zoomOutBtn"
                        class="rounded-lg bg-slate-200 px-3 py-2 hover:bg-slate-300"
                    >
                        Zoom -
                    </button>

                    <button
                        type="button"
                        id="rotateLeftBtn"
                        class="rounded-lg bg-slate-200 px-3 py-2 hover:bg-slate-300"
                    >
                        Putar Kiri
                    </button>

                    <button
                        type="button"
                        id="applyCropBtn"
                        class="rounded-lg bg-emerald-600 px-3 py-2 text-white hover:bg-emerald-700"
                    >
                        Gunakan Hasil Crop
                    </button>
                </div>

                <div id="cropResultArea" class="mt-4 hidden">
                    <p class="mb-2 text-sm text-slate-600">Preview hasil crop:</p>
                    <img
                        id="cropResult"
                        class="h-24 w-24 rounded-full border border-slate-300 object-cover"
                        alt="Hasil Crop"
                    >
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let cropper = null;

    const photoInput = document.getElementById('photoInput');
    const photoFileName = document.getElementById('photoFileName');
    const cropArea = document.getElementById('cropArea');
    const cropImage = document.getElementById('cropImage');
    const croppedPhoto = document.getElementById('croppedPhoto');
    const cropResultArea = document.getElementById('cropResultArea');
    const cropResult = document.getElementById('cropResult');

    const zoomInBtn = document.getElementById('zoomInBtn');
    const zoomOutBtn = document.getElementById('zoomOutBtn');
    const rotateLeftBtn = document.getElementById('rotateLeftBtn');
    const applyCropBtn = document.getElementById('applyCropBtn');

    if (photoInput) {
        photoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file) {
                return;
            }

            photoFileName.textContent = file.name;

            const reader = new FileReader();

            reader.onload = function (e) {
                cropArea.classList.remove('hidden');
                cropResultArea.classList.add('hidden');
                croppedPhoto.value = '';

                cropImage.src = e.target.result;

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    background: false,
                    responsive: true,
                    movable: true,
                    zoomable: true,
                    rotatable: true,
                    scalable: false,
                });
            };

            reader.readAsDataURL(file);
        });
    }

    if (zoomInBtn) {
        zoomInBtn.addEventListener('click', function () {
            if (cropper) {
                cropper.zoom(0.1);
            }
        });
    }

    if (zoomOutBtn) {
        zoomOutBtn.addEventListener('click', function () {
            if (cropper) {
                cropper.zoom(-0.1);
            }
        });
    }

    if (rotateLeftBtn) {
        rotateLeftBtn.addEventListener('click', function () {
            if (cropper) {
                cropper.rotate(-90);
            }
        });
    }

    if (applyCropBtn) {
        applyCropBtn.addEventListener('click', function () {
            if (!cropper) {
                return;
            }

            const canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            const croppedData = canvas.toDataURL('image/jpeg', 0.9);

            croppedPhoto.value = croppedData;
            cropResult.src = croppedData;
            cropResultArea.classList.remove('hidden');
        });
    }

    const form = photoInput?.closest('form');

    if (form) {
        form.addEventListener('submit', function () {
            if (cropper && !croppedPhoto.value) {
                const canvas = cropper.getCroppedCanvas({
                    width: 400,
                    height: 400,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                croppedPhoto.value = canvas.toDataURL('image/jpeg', 0.9);
            }
        });
    }
</script>
@endpush