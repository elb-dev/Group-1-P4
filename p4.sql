INSERT INTO category
    (category_id, subject, category_description, date_added)
VALUES
    (1, 'Engineer', 'Topics on progressive thinking and science', Now()),
    (2, 'Entertainment', 'Movies, Music, TV, Art, Celebrities, and more', Now()),
    (3, 'Sports', 'Lastest news on scores, stats, standings and rumors', Now());
    
    
/*Create table for news feed*/

    DROP TABLE IF EXISTS feed;
CREATE TABLE feed(
    feed_id INT(10) NOT NULL AUTO_INCREMENT,
    subject VARCHAR(25) DEFAULT NULL,
    feed_URL text,
    feed_description text,
    category_id INT(10) unsigned NOT NULL,
    date_added DATETIME,
    LastUpdated TIMESTAMP
        DEFAULT 0 ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (feed_id),
    INDEX ux_category_id (category_id)
    CONSTRAINT fk_category_feed
        UNIQUE (subject),
        FOREIGN KEY (category_id)
        REFERENCES category(category_id)
        ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
INSERT INTO feed
    (feed_id, subject, feed_URL, feed_description, category_id, date_added)
VALUES
    (1, 'Civil Engineering', 'https://www.realwire.com/rss/?id=621&row=&view=Synopsis', 'Housing, Roadwork, and Services', 1, Now()),
    (2, 'Nanotechnology', 'https://www.realwire.com/rss/?id=683&row=&view=Synopsis', 'Really really reeeaaalllyyy tiny technology', 1, Now()),
    (3, 'Microwaves/Radiowaves', 'https://www.realwire.com/rss/?id=576&row=&view=Synopsis', 'The deepest mystery is in the invisible', 1, Now()),
    (4, 'Music', 'https://www.realwire.com/rss/?id=509&row=&view=Synopsis', 'Lastest in Realwire Music', 2, Now()),
    (5, 'DVD/Music', 'https://www.realwire.com/rss/?id=649&row=&view=Synopsis', 'DVD/Film Lastest Feeds', 2, Now()),
    (6, 'Art', 'https://www.realwire.com/rss/?id=628&row=&view=Synopsis', 'Most recent entertainment-art articles', 2, Now()),
    (7, 'MLB', 'https://api.foxsports.com/v1/rss?partnerKey=zBaFxRyGKCfxBagJG9b8pqLyndmvo7UU&tag=mlb', 'Major League Baseball', 3, Now()),
    (8, 'NFL', 'https://api.foxsports.com/v1/rss?partnerKey=zBaFxRyGKCfxBagJG9b8pqLyndmvo7UU&tag=nfl', 'National Football League', 3, Now()),
    (9, 'NBA', 'https://api.foxsports.com/v1/rss?partnerKey=zBaFxRyGKCfxBagJG9b8pqLyndmvo7UU&tag=nba', 'National Basketball Association', 3, Now());
    
    
