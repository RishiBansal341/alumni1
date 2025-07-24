@echo off
cd /d %~dp0

echo Activating virtual environment...
call .venv\Scripts\activate

echo Installing required Python packages...
python -m pip install --upgrade pip
python -m pip install streamlit

echo Starting PHP server on localhost:8000...
start cmd /k "php -S localhost:8000 -t alumni1"

echo Starting Python backend (app.py)...
cd alumni1
start cmd /k "python app.py"

echo All servers started!
pause
