<x-app-layout>
    <x-slot name="header">
        <div class="bg-slate-900 border-b-2 border-amber-600 p-4 rounded-xl shadow-xl">
            <h2 class="font-black text-xl text-white tracking-tight">
                {{ __('Edytuj swoją opinię o komisie') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-2xl sm:rounded-lg p-6 border border-slate-800 border-t-4 border-amber-600">

                <form action="{{ route('reviews.update', $review) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Twoja ocena (1-5 gwiazdek)</label>
                        <select name="rating" required class="w-full text-sm rounded bg-white text-slate-900 border-slate-300 focus:ring-blue-500 focus:border-blue-500">
                            <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>★★★★★ 5 / 5 (Doskonale)</option>
                            <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>★★★★☆ 4 / 5 (Bardzo dobrze)</option>
                            <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>★★★☆☆ 3 / 5 (Przeciętnie)</option>
                            <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>★★☆☆☆ 2 / 5 (Słabo)</option>
                            <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>★☆☆☆☆ 1 / 5 (Nie polecam)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Komentarz tekstowy</label>
                        <textarea name="comment" rows="4" required class="w-full text-sm rounded bg-white text-slate-900 border-slate-300 focus:ring-blue-500 focus:border-blue-500">{{ old('comment', $review->comment) }}</textarea>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-slate-800">
                        <a href="{{ route('dashboard') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-2 px-4 rounded-lg text-sm transition">
                            Anuluj
                        </a>
                        <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white font-bold py-2 px-4 rounded-lg text-sm transition shadow-md">
                            Zapisz zmiany
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
