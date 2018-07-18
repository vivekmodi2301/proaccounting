


INSERT INTO client VALUES("1","Murlidhar Pittie","Bkn","1","1683","dr");
INSERT INTO client VALUES("2","Ramadevi Ganesh Das Bagree","Bkn","1","3600","dr");
INSERT INTO client VALUES("3","Phoenix IIT","Bkn","1","317000","dr");
INSERT INTO client VALUES("4","Khirajram Saran","Bkn","1","5100","dr");
INSERT INTO client VALUES("7","RSV","JNV Colony","1","30000","dr");
INSERT INTO client VALUES("8","RNRSV","JNV Colony","1","30000","dr");
INSERT INTO client VALUES("9","NNRSV","JNV Colony","1","30000","dr");
INSERT INTO client VALUES("10","Rashtriya Sahayak Sr. Sec. School","JNV Colony","1","26500","dr");
INSERT INTO client VALUES("11","Bal Niketan","JNV Colony","1","26500","dr");



INSERT INTO edition VALUES("1","Dainik Bhaskar","1","dr","1683");
INSERT INTO edition VALUES("2","","1","dr","3600");
INSERT INTO edition VALUES("3","","1","dr","317000");
INSERT INTO edition VALUES("4","","1","dr","5100");
INSERT INTO edition VALUES("7","Dainik Bhaskar","1","dr","90000");
INSERT INTO edition VALUES("8","Dainik Bhaskar","1","dr","26500");
INSERT INTO edition VALUES("9","Dainik Bhaskar","1","dr","26500");



INSERT INTO invoice VALUES("1","1","6088","2017-03-23","1","2017-03-23","Bkn","2017-03-18","","187","0","0","0","1683","0","0","1683","1683","","1","2017-04-01","3*3","0","yes");
INSERT INTO invoice VALUES("2","2","6090","2017-03-24","2","2017-04-01","Bkn","2017-03-25","","3600","0","0","0","3600","0","0","3600","3600","","1","2017-04-01","5*8","0","yes");
INSERT INTO invoice VALUES("3","3","6097","2017-03-30","3","2017-03-31","Bkn","2017-03-31","","","","","","","","","317000","317000","","1","2017-04-01","45*33","0","yes");
INSERT INTO invoice VALUES("4","4","6100","2017-04-01","4","2017-04-01","Bkn","2017-04-01","","5100","","","","","","","5100","5100","","1","2017-04-01","10*8","0","yes");
INSERT INTO invoice VALUES("7","7","6093","2017-03-30","5","2017-03-30","Bkn","2017-03-30","","820","","","","30000","","","30000","30000","","1","2017-04-17","41*20","0","yes");
INSERT INTO invoice VALUES("8","8","6093","2017-03-30","6","2017-03-30","Bkn","2017-03-30","","870","","","","30000","","","30000","30000","","1","2017-04-17","41*20","0","yes");
INSERT INTO invoice VALUES("9","9","6093","2017-03-30","7","2017-03-30","Bkn","2017-03-30","","870","","","","30000","","30000","30000","30000","","1","2017-04-17","41*20","0","yes");
INSERT INTO invoice VALUES("10","10","6098","2017-03-31","8","2017-03-31","Bkn","2017-03-31","","727","","","","26500","","","26500","26500","","1","2017-04-17","25*16","0","yes");
INSERT INTO invoice VALUES("11","11","6098","2017-03-31","9","2017-03-31","Bkn","2017-03-31","","727","","","","26500","","","26500","26500","","1","2017-04-17","25*16","0","yes");






INSERT INTO releaseorder VALUES("1","1","6088","2017-04-01","Bkn","3*3","187","0","2017-03-18","1683","","1","2017-03-23","1","1","cash","yes","Required");
INSERT INTO releaseorder VALUES("2","2","6090","2017-04-01","Bkn","5*8","3600","","2017-03-25","3600","","1","2017-03-24","0","1","cash","yes","Shok");
INSERT INTO releaseorder VALUES("3","3","6097","2017-04-01","Bkn","45*33","3200","0","2017-03-31","310000","","1","2017-03-30","1","1","cash","yes","");
INSERT INTO releaseorder VALUES("4","4","6100","2017-04-01","Bkn","10*8","5100","0","2017-04-01","5100","","1","2017-04-01","1","1","cash","yes","Shok");
INSERT INTO releaseorder VALUES("7","7","6093","2017-04-17","Bkn","41*20","820","","2017-04-30","90000","","1","2017-03-30","0","1","cash","yes","Display");
INSERT INTO releaseorder VALUES("8","10","6098","2017-04-17","Bkn","25*16","727","","2017-03-31","26500","","1","2017-03-31","0","1","cash","yes","Display");



