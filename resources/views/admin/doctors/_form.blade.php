<div class="grid md:grid-cols-2 gap-4">
<div><label class="font-medium">Nama Dokter</label><input name="name" value="{{ old('name', $doctor->name ?? '') }}" class="mt-1 w-full rounded-lg border-slate-300" required></div>
<div><label class="font-medium">Spesialisasi</label><input name="specialization" value="{{ old('specialization', $doctor->specialization ?? '') }}" class="mt-1 w-full rounded-lg border-slate-300" required></div>
<div><label class="font-medium">No STR</label><input name="str_number" value="{{ old('str_number', $doctor->str_number ?? '') }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
<div><label class="font-medium">No HP</label><input name="phone" value="{{ old('phone', $doctor->phone ?? '') }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
<div><label class="font-medium">URL Foto</label><input name="photo" value="{{ old('photo', $doctor->photo ?? '') }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
<div><label class="font-medium">Biaya Konsultasi</label><input name="consultation_fee" type="number" min="0" value="{{ old('consultation_fee', $doctor->consultation_fee ?? 0) }}" class="mt-1 w-full rounded-lg border-slate-300" required></div>
<div class="md:col-span-2"><label class="inline-flex items-center gap-2"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $doctor->is_active ?? true))> Aktif</label></div>
</div><button class="mt-5 rounded-lg bg-emerald-600 px-4 py-2 text-white">Simpan</button>
