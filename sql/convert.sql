insert into other_info
SELECT 
cont.`intResortContentID` ,
zz.`intParentCountry` , 
'0', 
cont.`varName`,
cont.`varContent`,
cont.`varUrlAlias`,
cont.`varPageTitle`,
cont.`varPageDescription`,
cont.`varPageKeywords`,
cont.`varH1Text`,
cont.`intOrdering`,
cont.`isActive`


FROM `adv_resorts_content` as cont 
LEFT JOIN adv_resorts as res ON res.intResortID = cont.intResortID  
LEFT JOIN adv_countries as zz ON zz.intCountryID = res.intCountryID  	
WHERE res.intTypeBlock = 1;

insert into attractions
SELECT 
cont.`intResortContentID` ,
zz.`intParentCountry` , 
'0', 
cont.`varName`,
cont.`varContent`,
cont.`varUrlAlias`,
cont.`varPageTitle`,
cont.`varPageDescription`,
cont.`varPageKeywords`,
cont.`varH1Text`,
cont.`intOrdering`,
cont.`isActive`


FROM `adv_resorts_content` as cont 
LEFT JOIN adv_resorts as res ON res.intResortID = cont.intResortID  
LEFT JOIN adv_countries as zz ON zz.intCountryID = res.intCountryID  	
WHERE res.intTypeBlock = 0;