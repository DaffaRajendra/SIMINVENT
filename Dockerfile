FROM dunglas/frankenphp:php8.3-bookworm

WORKDIR /app

COPY . /app

# Render mengisi variabel PORT otomatis
CMD ["sh", "-c", "frankenphp php-server --listen :${PORT:-80} --root /app"]
