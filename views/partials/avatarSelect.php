<label class="aspect-square w-full transition-all duration-150 ease-in-out hover:drop-shadow-2xl/70 hover:scale-105 cursor-pointer block">
    <input type="radio" name="avatar" value="<?= htmlspecialchars($img) ?>" class="peer hidden" <?= ($selectedAvatar === $img) ? 'checked' : '' ?>>
    <img src="../public/img/avatars/<?= htmlspecialchars($img) ?>" class="w-full h-full object-cover rounded-md peer-checked:ring-4 peer-checked:ring-money-green">
</label>