{"version":3,"file":"public.bundle.map.js","names":["this","BX","Messenger","v2","exports","main_core","legacyMessenger","openMessenger","console","error","messenger","openChat","arguments","openNotify","openNotifications","openSettings","callTo","startVideoCall","popupPopupMenu","constructor","v2enabled","settings","Extension","getSettings","get","dialogId","text","Promise","resolve","reject","window","BXIM","MessengerSlider","Reflection","getClass","getInstance","openLines","openRecentSearch","options","params","Type","isPlainObject","isStringFilled","selected","active","section","onlyPanel","withVideo","DesktopManager","checkRunStatus","then","catch","namespace","Public","isUndefined","parent","Lib"],"sources":["public.bundle.js"],"mappings":"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"}