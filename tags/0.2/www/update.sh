#!/bin/sh

svn co file:///svnroot/repos/htdoogle/trunk/www .
svn --non-recursive co file:///svnroot/repos/htdoogle/trunk trunk
chmod -R 755 *
