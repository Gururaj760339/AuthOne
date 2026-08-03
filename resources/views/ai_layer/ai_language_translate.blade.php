<form>
    <select onchange="window.location.href=this.value"
        class="border rounded-lg px-3 py-2">

        <option value="{{ route('language.switch','en') }}"
            {{ session('language')=='en' ? 'selected' : '' }}>
            🇺🇸 English
        </option>

        <option value="{{ route('language.switch','ar') }}"
            {{ session('language')=='ar' ? 'selected' : '' }}>
            🇸🇦 Arabic
        </option>

        <option value="{{ route('language.switch','de') }}"
            {{ session('language')=='de' ? 'selected' : '' }}>
            🇩🇪 German
        </option>

    </select>
</form>