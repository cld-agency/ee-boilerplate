eecli create:status --color="F26F2E" "Draft" 1 &&
eecli create:channel --new_field_group products &&
eecli create:channel --new_field_group blog &&
eecli create:upload_pref --images_only "Images" / /images &&
eecli create:upload_pref "Downloads" / /downloads &&
eecli create:template pages/index