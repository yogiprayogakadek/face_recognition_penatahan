@echo off
SETLOCAL

:: 1. Buat virtual environment
echo [1/4] Membuat virtual environment...
py -m venv venv
IF %ERRORLEVEL% NEQ 0 (
    echo Gagal membuat virtual environment.
    pause
    exit /b
)

:: 2. Aktifkan virtual environment
echo [2/4] Mengaktifkan virtual environment...
call venv\Scripts\activate.bat
IF %ERRORLEVEL% NEQ 0 (
    echo Gagal mengaktifkan virtual environment.
    pause
    exit /b
)

:: 3. Install requirements
echo [3/4] Menginstal dependensi dari requirements.txt...
pip install --upgrade pip
pip install -r requirements.txt
IF %ERRORLEVEL% NEQ 0 (
    echo Gagal menginstal requirements.
    pause
    exit /b
)

:: 4. Jalankan app.py
echo [4/4] Menjalankan app.py...
python app.py

ENDLOCAL
pause
