<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('check:expense-due')->daily();
