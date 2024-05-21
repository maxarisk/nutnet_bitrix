{"version":3,"file":"core.bundle.map.js","names":["this","BX","Messenger","Embedding","exports","im_oldChatEmbedding_application_launch","pull_client","rest_client","main_core","ui_vue3","ui_vue3_vuex","im_oldChatEmbedding_model","im_oldChatEmbedding_const","im_oldChatEmbedding_provider_pull","im_oldChatEmbedding_lib_logger","im_oldChatEmbedding_lib_utils","im_oldChatEmbedding_lib_smileManager","CoreApplication","constructor","params","applicationData","inited","initPromise","Promise","resolve","initPromiseResolver","offline","vuexAdditionalModel","store","storeBuilder","pullHandlers","prepareParams","initStorage","then","initPullClient","initComplete","catch","error","Logger","_params$host","Type","isUndefined","localize","message","host","location","origin","userId","prepareUserId","siteId","getLocalize","isStringFilled","siteDir","languageId","initPull","initRest","initVuexBuilder","applicationVariables","common","getHost","getUserId","getSiteId","getLanguageId","dialog","messageLimit","enableReadMessages","device","type","Utils","isMobile","DeviceType","mobile","desktop","orientation","getOrientation","builder","Builder","init","addModel","ApplicationModel","create","useDatabase","setVariables","DialoguesModel","UsersModel","RecentModel","forEach","model","setDatabaseConfig","name","vuexBuilder","databaseName","databaseType","build","result","pullClient","subscribe","BasePullHandler","RecentPullHandler","pullInstance","SubscriptionType","Status","callback","eventStatusInteraction","bind","Online","eventOnlineInteraction","restInstance","RestClient","restClient","rest","instance","client","PullClient","PULL","pull","database","BuilderDatabaseType","indexedDb","isBoolean","isArray","models","addVuexModel","parsedUserId","Number","parseInt","data","status","PullStatus","Offline","includes","command","Object","values","users","userInfo","dispatch","id","fields","createVue","application","config","beforeCreateFunction","beforeCreate","unmountedFunction","unmounted","createdFunction","created","controller","initConfig","$bitrix","Data","set","Application","Loc","setMessage","el","template","computed","components","initConfigCreatedFunction","bitrixVue","BitrixVue","createApp","errorHandler","err","vm","info","console","warnHandler","warn","trace","use","mount","getStore","getRestClient","setApplicationData","applicationName","getApplicationData","_this$applicationData","push","isOnline","ready","addLocalize","phrases","isPlainObject","entries","key","value","phrase","toString","Core","Vue3","Vuex","Model","Const","Provider","Pull","Lib"],"sources":["core.bundle.js"],"mappings":"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"}