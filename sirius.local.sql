INSERT IGNORE INTO zone (id, name) VALUES
    (1, "main");
    
INSERT IGNORE INTO safari (id, name, length) VALUES
    (1, "surf safari", 180),
    (2, "custom safari", 0);

INSERT IGNORE INTO user (id, email, password, fname, userlevel, zone_id) VALUES
    (1, "hugo@astrek.net", "6b6bf838063e554f031da357336f5be30a04f8786926be4e4a3e0c417215abf2", "Hugo", 3, 1);
