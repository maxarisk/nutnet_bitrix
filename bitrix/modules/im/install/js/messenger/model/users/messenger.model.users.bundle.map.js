{"version":3,"sources":["messenger.model.users.bundle.js"],"names":["exports","ModelUsers","babelHelpers","classCallCheck","this","createClass","key","value","getStore","params","arguments","length","undefined","namespaced","state","host","location","protocol","collection","index","actions","set","store","payload","Array","map","user","Object","assign","getUserBlank","validate","init","result","push","commit","update","id","userId","fields","delete","_delete","mutations","_iteratorNormalCompletion","_didIteratorError","_iteratorError","_iterator","Symbol","iterator","_step","next","done","element","BX","Vue","err","return","getInstance","getName","convertToArray","object","i","hasOwnProperty","defaultName","name","firstName","lastName","workPosition","color","avatar","gender","birthday","extranet","network","bot","connector","externalAuthId","status","idle","lastActivityDate","mobileLastDate","departments","absent","phones","workPhone","personalMobile","personalPhone","options","parseInt","first_name","last_name","toString","elementsOfName","split","join","trim","_elementsOfName","work_position","startsWith","external_auth_id","Date","last_activity_date","mobile_last_date","forEach","departmentId","typeof","work_phone","personal_mobile","personal_phone","window","Messenger","Model","Users"],"mappings":"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","file":"messenger.model.users.bundle.map.js"}