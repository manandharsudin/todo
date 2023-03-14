module.exports = function( grunt ) {
    'use strict';
    var pkgInfo = grunt.file.readJSON('package.json');
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        //Compressing of javascript files
        uglify: {            
            dist: {
                options: {
                    banner: '/*! <%= pkg.name %> <%= pkg.version %> <%= grunt.template.today("yyyy-mm-dd h:MM:ss TT") %> */\n',
                    report: 'gzip'
                },
                files: {
                    'assets/js/custom.min.js'             : [ 'assets/js/custom.js' ],
                    'assets/js/customize.min.js'          : [ 'assets/js/customize.js' ],
                    'assets/js/customizer.min.js'         : [ 'assets/js/customizer.js' ],
                    'assets/js/modal-accessibility.min.js': [ 'assets/js/modal-accessibility.js' ],
                }
            }
        },
        // css minification
        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd   : 'assets/css',
                    src   : [ 'admin.css', 'customize.css', 'editor-block.css', 'gutenberg.css', 'woocommerce.css' ],
                    dest  : 'assets/css',
                    ext   : '.min.css'
                }]
            }
        }, 
        makepot: {
            target: {
                options: {
                    domainPath : '/',
                    potFilename: 'languages/todo.pot',
                    potHeaders : {
                        poedit                 : true,
                        'x-poedit-keywordslist': true
                    },
                    type           : 'wp-theme',
                    updateTimestamp: true
                }
            }
        },
        addtextdomain: {
            options: {
                updateDomains: true,   // List of text domains to replace.
            },
            target: {
                files: {
                    src: [
                        '*.php',
                        '**/*.php',
                        '!node_modules/**',
                    ]
                }
            }
        },
        copy: {
            main: {
                options: {
                    mode: true
                },
                src: [
                    '**',
                    '!node_modules/**',
                    '!Gruntfile.js',
                    '!package.json',
                    '!.gitignore',
                    '!package-lock.json',
                ],
                dest: 'todo/'
            }
        },
        compress: {
            main: {
                options: {
                    archive: 'todo_' + pkgInfo.version + '.zip',
                    mode   : 'zip'
                },
                files: [
                    {
                        src: [
                            './todo/**'
                        ]
                    }
                ]
            }
        },
        clean: {
            main: ["todo"],
            zip : ["*.zip"]
        },
        bumpup: {
            options: {
                updateProps: {
                    pkg: 'package.json'
                }
            },
            file: 'package.json'
        },
        replace: {
            theme_main: {
                src         : ['style.css','readme.txt' ],
                overwrite   : true,
                replacements: [
                    {
                        from: /Version: \bv?(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)(?:-[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?(?:\+[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?\b/g,
                        to  : 'Version: <%= pkg.version %>'
                    },
                    {
                        from: /Stable tag: \bv?(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)(?:-[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?(?:\+[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?\b/g,
                        to  : 'Stable tag: <%= pkg.version %>'
                    }
                ]
            },
        },

    });
    // Load NPM tasks to be used here
    grunt.loadNpmTasks( 'grunt-wp-i18n' );
    grunt.loadNpmTasks( 'grunt-contrib-jshint' );
    grunt.loadNpmTasks( 'grunt-contrib-uglify' );
    grunt.loadNpmTasks( 'grunt-contrib-copy' );
    grunt.loadNpmTasks( 'grunt-contrib-compress' );
    grunt.loadNpmTasks( 'grunt-contrib-clean' );
    grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
    grunt.loadNpmTasks( 'grunt-bumpup' );
    grunt.loadNpmTasks( 'grunt-text-replace' );

    // To release new version just runt 2 commands below
    // Re create everything: grunt release --ver=<version_number>
    // Zip file installable: grunt zipfile
    grunt.registerTask('zipfile', ['clean:zip', 'copy:main', 'compress:main', 'clean:main']);
    grunt.registerTask('release', function (ver) {
        var newVersion = grunt.option('ver');
        if (newVersion) {
            // Replace new version
            newVersion = newVersion ? newVersion : 'patch';
            grunt.task.run('bumpup:' + newVersion);
            grunt.task.run('replace');
            // i18n
            grunt.task.run(['addtextdomain', 'makepot']);
            // re create css file and min
            grunt.task.run([ 'uglify', 'cssmin' ]);
        }
    });
    grunt.registerTask( 'default', [ 'addtextdomain', 'makepot', 'cssmin', 'uglify' ] );
};