var	filesData = {
	files:  [
		{
			fileName: "../pic/sparks/spark1.png",
			fileSize: 1492 
		},
		{
			fileName: "../pic/sparks/spark2.png",
			fileSize: 1448 
		},
		{
			fileName: "../pic/sparks/spark3.png",
			fileSize: 1397 
		},
		{
			fileName: "../pic/sparks/spark4.png",
			fileSize: 916 
		}
	],
	totalFiles: 5,
	totalSize: 5253
};
var toRad = function (deg) {
        return deg * Math.PI / 180
    },
    states = [
    {
        'f-part1': {
            type: 'path',
                width: 45,
                height: 40,
                duration: 1000,
                color: 'rgba(255,255,255,0.2)',
                params: {
                x: -443,
                    y: 0,
                    angle: 0,
                    alpha: 1,
                    scaleX: 1,
                    scaleY: 1
            },
            path: [
                {
                    id: 0,
                    x: -29,
                    y: -37,
                    type: 'line'
                },
                {
                    id: 1,
                    x: -29,
                    y: -60,
                    type: 'line'
                },
                {
                    id: 2,
                    x: -2,
                    y: -60,
                    type: 'line'
                }
            ]
        },
        'r-part1': {
            type: 'path',
            width: 18,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
            x: -330,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
        },
            path: [
                {
                    id: 0,
                    x: 22,
                    y: -32,
                    type: 'line'
                },
                {
                    radius: 24,
                    angleStart: Math.PI * 1.6,
                    angleEnd: Math.PI * 1.75,
                    x: 24,
                    y: -32,
                    type: 'circle'
                },
                {
                    id: 0,
                    x: 24,
                    y: -30,
                    type: 'line'
                },
                {
                    id: 0,
                    x: 24,
                    y: -30,
                    type: 'line'
                }
            ]
    },
        'r-part2': {
        type: 'path',
            width: 28,
            height: 24,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
            x: -330,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
        },
        path: [
            {
                x: 28,
                y: 55,
                type: 'line'
            },
            {
                x: 43,
                y: 37,
                type: 'line'
            },
            {
                x: 57,
                y: 60,
                type: 'line'
            },
            {
                x: 32,
                y: 60,
                type: 'line'
            }
        ]
    },
        'o-part1': {
            type: 'path',
            width: 18,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -202,
                y: -5,
                angle: -0.05,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 36,
                    angleStart: 1.9548,
                    angleEnd: 0.7330,
                    x: 0,
                    y: 0,
                    type: 'circle',
                    antiClockwise: true
                },
                {
                    radius: 59,
                    angleStart: 1.1,
                    angleEnd: 2.0944,
                    x: 0,
                    y: 0,
                    type: 'circle'
                }
            ]
        },
        'n-part1': {
            type: 'path',
                width: 24,
                height: 30,
                duration: 1000,
                color: 'rgba(255,255,255,0.2)',
                params: {
                x: -67,
                    y: 0,
                    angle: 0,
                    alpha: 1,
                    scaleX: 1,
                    scaleY: 1
            },
            path: [
                {
                    x: -37,
                    y: 60,
                    type: 'line'
                },
                {
                    x: -37,
                    y: 30,
                    type: 'line'
                },
                {
                    x: -15,
                    y: 58,
                    type: 'line'
                },
                {
                    x: -15,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'n-part2': {
            type: 'path',
                width: 24,
                height: 30,
                duration: 1000,
                color: 'rgba(255,255,255,0.2)',
                params: {
                x: -67,
                    y: 0,
                    angle: 0,
                    alpha: 1,
                    scaleX: 1,
                    scaleY: 1
            },
            path: [
                {
                    x: 33,
                    y: -11,
                    type: 'line'
                },
                {
                    x: 33,
                    y: -36,
                    type: 'line'
                },
                {
                    x: 56,
                    y: -12,
                    type: 'line'
                },
                {
                    x: 56,
                    y: 16,
                    type: 'line'
                }
            ]
        },
        'n-part3': {
        type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
            x: -67,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
        },
        path: [
            {
                x: 46,
                y: -60,
                type: 'line'
            },
            {
                x: 56,
                y: -60,
                type: 'line'
            },
            {
                x: 56,
                y: -52,
                type: 'line'
            }
        ]
    },
        'd-part1': {
        type: 'path',
            width: 7,
            height: 20,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
            x: 65,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
        },
            path: [
                {
                    x: -8,
                    y: 60,
                    type: 'line'
                },
                {
                    x: -8,
                    y: 34,
                    type: 'line'
                },
                {
                    x: 0,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 0,
                    y: 60,
                    type: 'line'
                }
            ]
    },
        'e-part1': {
        type: 'path',
            width: 33,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
            x: 183,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
        },
        path: [
            {
                x: 10,
                y: 60,
                type: 'line'
            },
            {
                x: 30,
                y: 37,
                type: 'line'
            },
            {
                x: 41,
                y: 37,
                type: 'line'
            },
            {
                x: 41,
                y: 60,
                type: 'line'
            }
        ]
    },
        'e-part2': {
        type: 'path',
            width: 5,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
            x: 183,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
        },
        path: [
            {
                x: 36,
                y: -37,
                type: 'line'
            },
            {
                x: 39,
                y: -60,
                type: 'line'
            },
            {
                x: 41,
                y: -60,
                type: 'line'
            },
            {
                x: 41,
                y: -37,
                type: 'line'
            }
        ]
    },
        'v-part1': {
        type: 'path',
            width: 22,
            height: 16,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
            x: 296,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
        },
        path: [
            {
                x: 41,
                y: -60,
                type: 'line'
            },
            {
                x: 41,
                y: -60,
                type: 'line'
            },
            {
                x: 64,
                y: -60,
                type: 'line'
            },
            {
                x: 57,
                y: -43,
                type: 'line'
            }
        ]
    },
        'o2-part1': {
            type: 'path',
            width: 49,
            height: 58,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 431,
                y: 3,
                angle: toRad(-44),
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 36,
                    angleStart: toRad(106),
                    angleEnd: toRad(76),
                    x: 0,
                    y: 0,
                    type: 'circle',
                    antiClockwise: true
                },
                {
                    radius: 55,
                    angleStart: toRad(43),
                    angleEnd: toRad(126),
                    x: 0,
                    y: 0,
                    type: 'circle'
                }
            ]
        }
    },


    // -----
    {
        'f-part1': {
            type: 'path',
            width: 45,
            height: 40,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -443,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    id: 0,
                    x: -29,
                    y: -37,
                    type: 'line'
                },
                {
                    id: 1,
                    x: -29,
                    y: -60,
                    type: 'line'
                },
                {
                    id: 2,
                    x: -2,
                    y: -60,
                    type: 'line'
                }
            ]
        },
        'r-part1': {
            type: 'path',
            width: 18,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -330,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 23,
                    angleStart: -toRad(70),
                    angleEnd: -toRad(47.6),
                    x: 19,
                    y: -33,
                    type: 'circle'
                },
                {
                    radius: 7,
                    angleStart: -toRad(53.1),
                    angleEnd: -toRad(66),
                    x: 19,
                    y: -33,
                    type: 'circle',
                    antiClockwise: true
                }
            ]
        },
        'r-part2': {
            type: 'path',
            width: 28,
            height: 24,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -330,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 26,
                    y: 52,
                    type: 'line'
                },
                {
                    x: 43,
                    y: 37,
                    type: 'line'
                },
                {
                    x: 57,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 32,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'o-part1': {
            type: 'path',
            width: 18,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -202,
                y: -5,
                angle: -0.65,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 36,
                    angleStart: 1.622,
                    angleEnd: 1.23,
                    x: 0,
                    y: 0,
                    type: 'circle',
                    antiClockwise: true
                },
                {
                    radius: 59,
                    angleStart: 1.35,
                    angleEnd: 1.8,
                    x: 0,
                    y: 0,
                    type: 'circle'
                }
            ]
        },
        'n-part1': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: -37,
                    y: 60,
                    type: 'line'
                },
                {
                    x: -37,
                    y: 30,
                    type: 'line'
                },
                {
                    x: -15,
                    y: 58,
                    type: 'line'
                },
                {
                    x: -15,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'n-part2': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 33,
                    y: -11,
                    type: 'line'
                },
                {
                    x: 33,
                    y: -27,
                    type: 'line'
                },
                {
                    x: 56,
                    y: -2,
                    type: 'line'
                },
                {
                    x: 56,
                    y: 16,
                    type: 'line'
                }
            ]
        },
        'n-part3': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 46,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 56,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 56,
                    y: -52,
                    type: 'line'
                }
            ]
        },
        'd-part1': {
            type: 'path',
            width: 7,
            height: 20,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 65,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: -8,
                    y: 60,
                    type: 'line'
                },
                {
                    x: -8,
                    y: 34,
                    type: 'line'
                },
                {
                    x: 0,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 0,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'e-part1': {
            type: 'path',
            width: 33,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 183,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 10,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 30,
                    y: 37,
                    type: 'line'
                },
                {
                    x: 41,
                    y: 37,
                    type: 'line'
                },
                {
                    x: 41,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'e-part2': {
            type: 'path',
            width: 5,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 183,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 36,
                    y: -37,
                    type: 'line'
                },
                {
                    x: 39,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 41,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 41,
                    y: -37,
                    type: 'line'
                }
            ]
        },
        'v-part1': {
            type: 'path',
            width: 22,
            height: 16,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 296,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 41,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 41,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 64,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 57,
                    y: -43,
                    type: 'line'
                }
            ]
        },
        'o2-part1': {
            type: 'path',
            width: 49,
            height: 58,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 431,
                y: 3,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 36,
                    angleStart: toRad(89),
                    angleEnd: toRad(54),
                    x: 0,
                    y: 0,
                    type: 'circle',
                    antiClockwise: true
                },
                {
                    radius: 55,
                    angleStart: toRad(68),
                    angleEnd: toRad(106),
                    x: 0,
                    y: 0,
                    type: 'circle'
                }
            ]
        }
    },
    {
        'f-part1': {
            type: 'path',
            width: 45,
            height: 40,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -443,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    id: 0,
                    x: -19,
                    y: -47,
                    type: 'line'
                },
                {
                    id: 1,
                    x: -19,
                    y: -70,
                    type: 'line'
                },
                {
                    id: 2,
                    x: 8,
                    y: -70,
                    type: 'line'
                }
            ]
        },
        'r-part1': {
            type: 'path',
            width: 18,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -340,
                y: 5,
                angle: toRad(-13),
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 28,
                    angleStart: -toRad(80),
                    angleEnd: -toRad(37.6),
                    x: 19,
                    y: -33,
                    type: 'circle'
                },
                {
                    radius: 0,
                    angleStart: -toRad(43.1),
                    angleEnd: -toRad(76),
                    x: 19,
                    y: -33,
                    type: 'circle',
                    antiClockwise: true
                }
            ]
        },
        'r-part2': {
            type: 'path',
            width: 28,
            height: 24,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -330,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 14,
                    y: 50,
                    type: 'line'
                },
                {
                    x: 33,
                    y: 36,
                    type: 'line'
                },
                {
                    x: 33,
                    y: 36,
                    type: 'line'
                },
                {
                    x: 22,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'o-part1': {
            type: 'path',
            width: 18,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -202,
                y: -5,
                angle: -0.18,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 36,
                    angleStart: toRad(90),
                    angleEnd: toRad(42),
                    x: 0,
                    y: 0,
                    type: 'circle',
                    antiClockwise: true
                },
                {
                    radius: 59,
                    angleStart: toRad(49),
                    angleEnd: toRad(111),
                    x: 0,
                    y: 0,
                    type: 'circle'
                }
            ]
        },
        'n-part1': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: -47,
                    y: 60,
                    type: 'line'
                },
                {
                    x: -47,
                    y: 30,
                    type: 'line'
                },
                {
                    x: -25,
                    y: 58,
                    type: 'line'
                },
                {
                    x: -25,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'n-part2': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67 - 10,
                y: 0 - 10,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 33,
                    y: -6 - 14,
                    type: 'line'
                },
                {
                    x: 33,
                    y: -27 - 11,
                    type: 'line'
                },
                {
                    x: 58,
                    y: -10,
                    type: 'line'
                },
                {
                    x: 58,
                    y: 16 - 8,
                    type: 'line'
                }
            ]
        },
        'n-part3': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67 - 10,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 46 - 7,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 58,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 58,
                    y: -52 + 10,
                    type: 'line'
                }
            ]
        },
        'd-part1': {
            type: 'path',
            width: 7,
            height: 20,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 65,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: -6,
                    y: 60,
                    type: 'line'
                },
                {
                    x: -6,
                    y: 34,
                    type: 'line'
                },
                {
                    x: 12,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 12,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'e-part1': {
            type: 'path',
            width: 33,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 183 - 5,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 10 - 14,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 30 - 10,
                    y: 37,
                    type: 'line'
                },
                {
                    x: 41,
                    y: 37,
                    type: 'line'
                },
                {
                    x: 41,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'e-part2': {
            type: 'path',
            width: 5,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 183 - 10,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 36 - 6,
                    y: -37,
                    type: 'line'
                },
                {
                    x: 39 - 28,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 41,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 41,
                    y: -37,
                    type: 'line'
                }
            ]
        },
        'v-part1': {
            type: 'path',
            width: 22,
            height: 16,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 296 - 5,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 41 - 10,
                    y: -60 + 12,
                    type: 'line'
                },
                {
                    x: 41 - 5,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 64 - 4,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 57 - 8,
                    y: -43 + 14,
                    type: 'line'
                }
            ]
        },
        'o2-part1': {
            type: 'path',
            width: 49,
            height: 58,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 431,
                y: 3,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 36,
                    angleStart: toRad(112),
                    angleEnd: toRad(86),
                    x: 0,
                    y: 0,
                    type: 'circle',
                    antiClockwise: true
                },
                {
                    radius: 55,
                    angleStart: toRad(90),
                    angleEnd: toRad(118),
                    x: 0,
                    y: 0,
                    type: 'circle'
                }
            ]
        }
    },
    {
        'f-part1': {
            type: 'path',
            width: 45,
            height: 40,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -443 - 17,
                y: 0 + 12,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    id: 0,
                    x: -29,
                    y: -37,
                    type: 'line'
                },
                {
                    id: 1,
                    x: -29,
                    y: -60,
                    type: 'line'
                },
                {
                    id: 2,
                    x: -2,
                    y: -60,
                    type: 'line'
                }
            ]
        },
        'r-part1': {
            type: 'path',
            width: 18,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -340,
                y: 6,
                angle: toRad(-7),
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 32,
                    angleStart: -toRad(90),
                    angleEnd: -toRad(27),
                    x: 19,
                    y: -33,
                    type: 'circle'
                },
                {
                    radius: 12,
                    angleStart: -toRad(4),
                    angleEnd: -toRad(80),
                    x: 19,
                    y: -33,
                    type: 'circle',
                    antiClockwise: true
                }
            ]
        },
        'r-part2': {
            type: 'path',
            width: 28,
            height: 24,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -330,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 10,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 29,
                    y: 46,
                    type: 'line'
                },
                {
                    x: 39,
                    y: 56,
                    type: 'line'
                },
                {
                    x: 10,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'o-part1': {
            type: 'path',
            width: 18,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -202,
                y: -5,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 36,
                    angleStart: toRad(100),
                    angleEnd: toRad(80),
                    x: 0,
                    y: 0,
                    type: 'circle',
                    antiClockwise: true
                },
                {
                    radius: 59,
                    angleStart: toRad(70),
                    angleEnd: toRad(114),
                    x: 0,
                    y: 0,
                    type: 'circle'
                }
            ]
        },
        'n-part1': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67 - 10,
                y: -20,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: -37,
                    y: 60 - 14,
                    type: 'line'
                },
                {
                    x: -37,
                    y: 22,
                    type: 'line'
                },
                {
                    x: -15,
                    y: 58 - 11,
                    type: 'line'
                },
                {
                    x: -15,
                    y: 60 + 10,
                    type: 'line'
                }
            ]
        },
        'n-part2': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67,
                y: -5,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 33 - 11,
                    y: -6 - 12,
                    type: 'line'
                },
                {
                    x: 33,
                    y: -6 - 12,
                    type: 'line'
                },
                {
                    x: 56 - 8,
                    y: -2,
                    type: 'line'
                },
                {
                    x: 48,
                    y: 11,
                    type: 'line'
                }
            ]
        },
        'n-part3': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67,
                y: 0 - 15,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 46 - 23,
                    y: -60 + 18,
                    type: 'line'
                },
                {
                    x: 56 - 15,
                    y: -60 + 18,
                    type: 'line'
                },
                {
                    x: 41,
                    y: -52 + 25,
                    type: 'line'
                }
            ]
        },
        'd-part1': {
            type: 'path',
            width: 7,
            height: 20,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 65,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: -4,
                    y: 44,
                    type: 'line'
                },
                {
                    x: 5,
                    y: 44,
                    type: 'line'
                },
                {
                    x: 23,
                    y: 70,
                    type: 'line'
                },
                {
                    x: 4,
                    y: 70,
                    type: 'line'
                }
            ]
        },
        'e-part1': {
            type: 'path',
            width: 33,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 183,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 10 + 10,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 30 - 20,
                    y: 37,
                    type: 'line'
                },
                {
                    x: 41 - 20,
                    y: 37,
                    type: 'line'
                },
                {
                    x: 41 - 5,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'e-part2': {
            type: 'path',
            width: 5,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 183,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 36 - 3,
                    y: -37 + 24,
                    type: 'line'
                },
                {
                    x: 39 - 2,
                    y: -60 + 47,
                    type: 'line'
                },
                {
                    x: 39 - 2,
                    y: -60 + 47,
                    type: 'line'
                },
                {
                    x: 41 - 4,
                    y: -37 + 29,
                    type: 'line'
                }
            ]
        },
        'v-part1': {
            type: 'path',
            width: 22,
            height: 16,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 296 - 14,
                y: 0 + 20,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 41 - 5,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 41 - 3,
                    y: -60 - 5,
                    type: 'line'
                },
                {
                    x: 64,
                    y: -60 - 5,
                    type: 'line'
                },
                {
                    x: 57 - 3,
                    y: -40,
                    type: 'line'
                }
            ]
        },
        'o2-part1': {
            type: 'path',
            width: 49,
            height: 58,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 431,
                y: 3,
                angle: toRad(-10),
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 36,
                    angleStart: toRad(95),
                    angleEnd: toRad(60),
                    x: 0,
                    y: 0,
                    type: 'circle',
                    antiClockwise: true
                },
                {
                    radius: 55,
                    angleStart: toRad(12),
                    angleEnd: toRad(96),
                    x: 0,
                    y: 0,
                    type: 'circle'
                }
            ]
        }

    }
],
    inStates = {
        'f': {
            params: {
                dirX: -1,
                dirY: 1
            }
        },
        'r': {
            params: {
                dirX: -1,
                dirY: -1
            }
        },
        'o': {
            params: {
                scale: 1.2,
                angle: Math.PI * 0.5,
                dirX: 0,
                dirY: 0
            }
        },
        'n': {
            params: {
                dirX: 1,
                dirY: 1
            }
        },
        'd': {
            params: {
                dirX: 0,
                dirY: -1
            }
        },
        'e': {
            params: {
                dirX: -1,
                dirY: -1
            }
        },
        'v': {
            params: {
                dirX: 1,
                dirY: 1
            }
        },
        'o2': {
            params: {
                scale: 1.2,
                angle: -Math.PI * 0.5,
                dirX: 0,
                dirY: 0
            }
        }
    },
    introStart = {
        'f': {
            type: 'path',
            width: 80,
            height: 120,
            duration: 1000,
            color: '#fff',
            params: {
                x: -443,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    id: 0,
                    x: -40,
                    y: 60,
                    type: 'line'
                },
                {
                    id: 1,
                    x: -40,
                    y: -21,
                    type: 'line'
                },
                {
                    x: 5,
                    y: -60,
                    type: 'line'
                },
                {
                    id: 2,
                    x: 40,
                    y: -60,
                    type: 'line'
                },
                {
                    id: 3,
                    x: 40,
                    y: -36,
                    type: 'line'
                },
                {
                    id: 4,
                    x: -15,
                    y: -36,
                    type: 'line'
                },
                {
                    id: 5,
                    x: -15,
                    y: -12,
                    type: 'line'
                },
                {
                    id: 6,
                    x: 36,
                    y: -12,
                    type: 'line'
                },
                {
                    id: 7,
                    x: 36,
                    y: 12,
                    type: 'line'
                },
                {
                    id: 8,
                    x: -15,
                    y: 12,
                    type: 'line'
                },
                {
                    id: 9,
                    x: -15,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'f-part1': {
            type: 'path',
            width: 45,
            height: 40,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -443,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    id: 0,
                    x: -29,
                    y: -37,
                    type: 'line'
                },
                {
                    id: 1,
                    x: -29,
                    y: -60,
                    type: 'line'
                },
                {
                    id: 2,
                    x: -2,
                    y: -60,
                    type: 'line'
                }
            ]
        },
        'r': {
            type: 'path',
            width: 92,
            height: 120,
            duration: 1000,
            color: 'rgba(255,255,255,1)',
            params: {
                x: -330,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    id: 0,
                    x: -47,
                    y: 60,
                    type: 'line'
                },
                {
                    id: 1,
                    x: -47,
                    y: -60,
                    type: 'line'
                },
                {
                    id: 2,
                    x: -25,
                    y: -60,
                    type: 'line'
                },
                {
                    id: 3,
                    x: -8,
                    y: -37,
                    type: 'line'
                },
                {
                    id: 4,
                    x: -22,
                    y: -37,
                    type: 'line'
                },
                {
                    id: 5,
                    x: -22,
                    y: 8,
                    type: 'line'
                },
                {
                    id: 6,
                    type: 'circle',
                    radius: 23,
                    angleStart: Math.PI * 0.5,
                    angleEnd: toRad(-19.2),
                    x: 0,
                    y: -15,
                    antiClockwise: true
                },
                {
                    id: 7,
                    type: 'circle',
                    radius: 45,
                    angleStart: toRad(-28.3),
                    angleEnd: toRad(61),
                    x: 0,
                    y: -15
                },
                {
                    id: 8,
                    x: 29,
                    y: 31,
                    type: 'line'
                },
                {
                    id: 9,
                    x: 13,
                    y: 45,
                    type: 'line'
                },
                {
                    id: 10,
                    x1: 0,
                    y1: 31,
                    x2: -8,
                    y2: 31,
                    type: 'quadratic'
                },
                {
                    id: 11,
                    x: -24,
                    y: 31,
                    type: 'line'
                },
                {
                    id: 12,
                    x: -24,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'r-part1': {
            type: 'path',
            width: 18,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -330,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 23,
                    angleStart: -toRad(70),
                    angleEnd: -toRad(47.6),
                    x: 19,
                    y: -33,
                    type: 'circle'
                },
                {
                    radius: 7,
                    angleStart: -toRad(53.1),
                    angleEnd: -toRad(66),
                    x: 19,
                    y: -33,
                    type: 'circle',
                    antiClockwise: true
                }
            ]
        },
        'r-part2': {
            type: 'path',
            width: 28,
            height: 24,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -330,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 28,
                    y: 55,
                    type: 'line'
                },
                {
                    x: 43,
                    y: 37,
                    type: 'line'
                },
                {
                    x: 57,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 32,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'o': {
            type: 'path',
            width: 118,
            height: 118,
            duration: 1000,
            color: '#fff',
            params: {
                x: -202,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1.02
            },
            path: [
                {
                    type: 'circle',
                    radius: 59,
                    angleStart: 2.2166,
                    angleEnd: 0.4189,
                    x: 0,
                    y: 0
                },
                {
                    type: 'circle',
                    radius: 36,
                    angleStart: 0.0873,
                    angleEnd: 2.1293,
                    x: 0,
                    y: 0,
                    antiClockwise: true
                }
            ]
        },
        'o-part1': {
            type: 'path',
            width: 18,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -202,
                y: -5,
                angle: -0.05,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 36,
                    angleStart: 1.9548,
                    angleEnd: 0.7330,
                    x: 0,
                    y: 0,
                    type: 'circle',
                    antiClockwise: true
                },
                {
                    radius: 59,
                    angleStart: 1.1,
                    angleEnd: 2.0944,
                    x: 0,
                    y: 0,
                    type: 'circle'
                }
            ]
        },
        'n': {
            type: 'path',
            width: 95,
            height: 120,
            duration: 1000,
            color: '#fff',
            params: {
                x: -67,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    id: 0,
                    type: 'line',
                    x: -48,
                    y: -16
                },
                {
                    id: 1,
                    type: 'line',
                    x: -48,
                    y: -60
                },
                {
                    id: 2,
                    type: 'line',
                    x: -32,
                    y: -60
                },
                {
                    id: 3,
                    type: 'line',
                    x: -32,
                    y: -60
                },
                {
                    id: 4,
                    type: 'line',
                    x: 22,
                    y: 12
                },
                {
                    id: 5,
                    type: 'line',
                    x: 22,
                    y: 12
                },
                {
                    id: 6,
                    type: 'line',
                    x: 22,
                    y: -13
                },
                {
                    id: 7,
                    type: 'line',
                    x: 47,
                    y: 17
                },
                {
                    id: 8,
                    type: 'line',
                    x: 47,
                    y: 60
                },
                {
                    id: 9,
                    type: 'line',
                    x: 30,
                    y: 60
                },
                {
                    id: 10,
                    type: 'line',
                    x: 30,
                    y: 60
                },
                {
                    id: 11,
                    type: 'line',
                    x: -23,
                    y: -11
                },
                {
                    id: 12,
                    type: 'line',
                    x: -23,
                    y: -11
                },
                {
                    id: 13,
                    type: 'line',
                    x: -23,
                    y: 12
                }
            ]

        },
        'n-part1': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: -37,
                    y: 60,
                    type: 'line'
                },
                {
                    x: -37,
                    y: 30,
                    type: 'line'
                },
                {
                    x: -15,
                    y: 58,
                    type: 'line'
                },
                {
                    x: -15,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'n-part2': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 33,
                    y: -11,
                    type: 'line'
                },
                {
                    x: 33,
                    y: -36,
                    type: 'line'
                },
                {
                    x: 56,
                    y: -12,
                    type: 'line'
                },
                {
                    x: 56,
                    y: 16,
                    type: 'line'
                }
            ]
        },
        'n-part3': {
            type: 'path',
            width: 24,
            height: 30,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: -67,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 46,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 56,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 56,
                    y: -52,
                    type: 'line'
                }
            ]
        },
        'd': {
            type: 'path',
            width: 104,
            height: 104,
            duration: 1000,
            color: '#fff',
            params: {
                x: 65,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1.133
            },
            path: [
                {
                    id: 0,
                    type: 'line',
                    x: -52,
                    y: 52
                },
                {
                    id: 1,
                    type: 'line',
                    x: -52,
                    y: -52
                },
                {
                    id: 2,
                    type: 'line',
                    x: 0,
                    y: -52
                },
                {
                    id: 3,
                    type: 'circle',
                    radius: 52,
                    angleStart: Math.PI * 1.5,
                    angleEnd: toRad(68.6),
                    x: 0,
                    y: 0
                },
                {
                    id: 4,
                    type: 'circle',
                    radius: 32,
                    angleStart: toRad(70),
                    angleEnd: -toRad(77.5),
                    x: -5,
                    y: 0,
                    antiClockwise: true
                },
                {
                    id: 5,
                    type: 'line',
                    x: -28,
                    y: -31
                },
                {
                    id: 6,
                    type: 'line',
                    x: -28,
                    y: 31
                },
                {
                    id: 7,
                    type: 'line',
                    x: -14,
                    y: 31
                },
                {
                    id: 8,
                    type: 'line',
                    x: -14,
                    y: 52
                }
            ]
        },
        'd-part1': {
            type: 'path',
            width: 7,
            height: 20,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 65,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: -8,
                    y: 60,
                    type: 'line'
                },
                {
                    x: -8,
                    y: 34,
                    type: 'line'
                },
                {
                    x: 0,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 0,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'e': {
            type: 'path',
            width: 80,
            height: 120,
            duration: 1000,
            color: '#fff',
            params: {
                x: 183,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    id: 0,
                    type: 'line',
                    x: -40,
                    y: 60
                },
                {
                    id: 1,
                    type: 'line',
                    x: -40,
                    y: -60
                },
                {
                    id: 2,
                    type: 'line',
                    x: -11,
                    y: -60
                },
                {
                    id: 3,
                    type: 'line',
                    x: 8,
                    y: -36
                },
                {
                    id: 4,
                    type: 'line',
                    x: -15,
                    y: -36
                },
                {
                    id: 5,
                    type: 'line',
                    x: -15,
                    y: -12
                },
                {
                    id: 6,
                    type: 'line',
                    x: 31,
                    y: -12
                },
                {
                    id: 7,
                    type: 'line',
                    x: 36,
                    y: -5
                },
                {
                    id: 8,
                    type: 'line',
                    x: 36,
                    y: 12
                },
                {
                    id: 9,
                    type: 'line',
                    x: -15,
                    y: 12
                },
                {
                    id: 10,
                    type: 'line',
                    x: -15,
                    y: 37
                },
                {
                    id: 11,
                    type: 'line',
                    x: 3,
                    y: 37
                },
                {
                    id: 12,
                    type: 'line',
                    x: -21,
                    y: 60
                }
            ]
        },
        'e-part1': {
            type: 'path',
            width: 33,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 183,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 10,
                    y: 60,
                    type: 'line'
                },
                {
                    x: 30,
                    y: 37,
                    type: 'line'
                },
                {
                    x: 41,
                    y: 37,
                    type: 'line'
                },
                {
                    x: 41,
                    y: 60,
                    type: 'line'
                }
            ]
        },
        'e-part2': {
            type: 'path',
            width: 5,
            height: 22,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 183,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 36,
                    y: -37,
                    type: 'line'
                },
                {
                    x: 39,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 41,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 41,
                    y: -37,
                    type: 'line'
                }
            ]
        },
        'v': {
            type: 'path',
            width: 80,
            height: 120,
            duration: 1000,
            color: '#fff',
            params: {
                x: 296,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    id: 0,
                    type: 'line',
                    x: -57,
                    y: -60
                },
                {
                    id: 1,
                    type: 'line',
                    x: -9,
                    y: 60
                },
                {
                    id: 2,
                    type: 'line',
                    x: 9,
                    y: 60
                },
                {
                    id: 3,
                    type: 'line',
                    x: 36,
                    y: -11
                },
                {
                    id: 4,
                    type: 'line',
                    x: 19,
                    y: -32
                },
                {
                    id: 5,
                    type: 'line',
                    x: 0,
                    y: 11
                },
                {
                    id: 6,
                    type: 'line',
                    x: -29,
                    y: -60
                }
            ]
        },
        'v-part1': {
            type: 'path',
            width: 22,
            height: 16,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 296,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    x: 41,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 41,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 64,
                    y: -60,
                    type: 'line'
                },
                {
                    x: 57,
                    y: -43,
                    type: 'line'
                }
            ]
        },
        'o2': {
            type: 'path',
            width: 118,
            height: 118,
            duration: 1000,
            color: 'rgba(255,255,255,1)',
            params: {
                x: 423,
                y: 0,
                angle: 0,
                alpha: 1,
                scaleX: 1,
                scaleY: 1.02
            },
            path: [
                {
                    type: 'circle',
                    radius: 36,
                    angleStart: 0.4712,
                    angleEnd: 1.9373,
                    x: 0,
                    y: 0,
                    antiClockwise: true
                },
                {
                    type: 'circle',
                    radius: 59,
                    angleStart: 2.1118,
                    angleEnd: -0.1047,
                    x: 0,
                    y: 0
                }
            ]
        },
        'o2-part1': {
            type: 'path',
            width: 49,
            height: 58,
            duration: 1000,
            color: 'rgba(255,255,255,0.2)',
            params: {
                x: 423 + 8,
                y: 0 + 3,
                angle: toRad(-44),
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            },
            path: [
                {
                    radius: 36,
                    angleStart: toRad(106),
                    angleEnd: toRad(76),
                    x: 0,
                    y: 0,
                    type: 'circle',
                    antiClockwise: true
                },
                {
                    radius: 55,
                    angleStart: toRad(48),
                    angleEnd: toRad(126),
                    x: 0,
                    y: 0,
                    type: 'circle'
                }
            ]
        }
    };
/*
    Intro Class
    Version:
    ---
    Frondevo corp.
    http://frondevo.com
    Author: Andrew "Bikkuri" Kosyack
*/
function Intro(params) {
    'use strict';
    var self = this,
        $indexTitle = $('.fd__index-title'),
        $img;

    if (!$indexTitle.length) {
        return;
    }

    $img = $indexTitle.find('img');

    if (!$img) {
        return;
    }

    $img.parent().append('<div class="ic-line ic-img"><div class="intro-wrap"><canvas id="intro" width="1200" height="160" data-intro="true"></canvas></div></div>');
    $img.remove();

    self.elems = {
        canvases: [
            $('#intro')
        ],
        ctxs: []
    };

    if (!self.elems.canvases[0].length) {
        return;
    }

    $.each(self.elems.canvases, function (key, canvas) {
        self.elems.ctxs.push(canvas[0].getContext('2d'));
    });

    self.canPlay = true;
    self.state = 0;

    if (self.canPlay) {
        self.entities = $.extend({}, introStart);
    } else {
        var ents = $.extend({}, introStart);
        self.entities = $.extend({}, $.extend(ents, states[self.state]));
    }

    self.settings = {
        debug: false,
        debugAnti: false,
        debugMain: false,
        debugParts: false,
        baseZoneRatio: 0.1242,
        //baseZoneRatio: 0.1333,
        baseLettersZone: {
            staticOffset: {
                x: 0,
                y: 0
            }
        },
        realLettersZone: {},
        actualLettersZone: {},
        debugAntiPath: {
            strokeStyle: 'rgba(255,0,0,0.5)',
            fillStyle: 'rgba(255,0,0,0.5)',
            composite: 'source-over'
        },
        width: (params && params.width) ? params.width : self.elems.canvases[0].width(),
        height: (params && params.height) ? params.height : self.elems.canvases[0].height()
    };
    // temporary
    self.canvasStretch();

    // set letters frame sizes
    self.settings.baseLettersZone.width = 966;
    self.settings.baseLettersZone.height = Math.round(self.settings.baseLettersZone.width * self.settings.baseZoneRatio);
    self.settings.baseLettersZone.ratio = 1;

    // set letters frame sizes
    self.settings.realLettersZone.width = 1202;
    self.settings.realLettersZone.height = Math.round(self.settings.realLettersZone.width * self.settings.baseZoneRatio);
    self.settings.realLettersZone.ratio = Math.round(self.settings.realLettersZone.width / self.settings.baseLettersZone.width);


    $.extend(self.settings, params);


    self.entitiesParts = {};
    self.pool = [];
    self.cache = [];

    // load images for entities
    FRONDEVO.controls.loader.loadImages(filesData.files, function (size, img, imgEntity) {
        var src = $(img).attr('src'),
            matched = src.match(/\/([a-zA-z0-9\-]+)\.png|jpg|gif|jpeg/i);
        if (matched) {
            // apply image for entity
            $.each(self.entities, function (key, entity) {
                if (key === matched[1]) {
                    entity.img = img;
                    entity.width = imgEntity.width;
                    entity.height = imgEntity.height;
                    entity.name = key;
                }
            });

            $.each(self.entitiesParts, function (key, entity) {
                if (key === matched[1]) {
                    entity.img = img;
                    entity.width = imgEntity.width;
                    entity.height = imgEntity.height;
                    entity.name = key;
                }
            });
        }
    }, function () {
        self.init(params);
    });

    return this;
}


Intro.prototype = {
    init: function () {
        'use strict';
        var self = this;

        self.resize();
        self.controls();

        //self.inAmimation();
        //self.getRandomLetter();

        return this;
    },
    strokes: function () {
        'use strict';
        var self = this,
            duration = 1500,
            btn,
            effect1 = {};

        FRONDEVO.controls.stroke = [];
        $('[data-stroke]').each(function (key, value) {
            var $parent = $(this).prev(),
                lWidth = parseInt($parent.css('border-width'));

            FRONDEVO.controls.stroke.push(
                new Stroke({
                    element: value,
                    x: 0,
                    y: 0,
                    strokeAlpha: 0.94,
                    fillColor: '#ffffff',
                    strokeColor: '#ff0000',
                    lineWidth: 3,
                    duration: duration
                })
            );
            btn = {
                width: 200,
                height: 50,
                x: 0,
                y: 0,
                duration: duration
            };
            effect1 = {
                duration: 1000,
                strokeAlpha: 0.5,
                lineWidth: lWidth * 2,
                strokeColor: '#fff',
                loop: false,
                pathes: [
                    {
                        type: 'line',
                        path: [
                            {
                                x0: 0,
                                y0: 0,
                                x1: 1,
                                y1: 0
                            },
                            {
                                x0: 1,
                                y0: 0,
                                x1: 1,
                                y1: 1
                            }
                        ]
                    },
                    {
                        type: 'line',
                        path: [
                            {
                                x0: 1,
                                y0: 1,
                                x1: 0,
                                y1: 1
                            },
                            {
                                x0: 0,
                                y0: 1,
                                x1: 0,
                                y1: 0
                            }
                        ]
                    }
                ],
                onStart: function (param) {
                    setTimeout(function () {
                        param.entity.parent().find('.button').removeClass('hidden');
                    }, duration * 0.5);
                }
            };
            FRONDEVO.controls.stroke[key].addEntity(effect1);
        });

        return this;
    },
    inAmimation: function () {
        'use strict';

        if (!this.elems || !this.elems.canvases || !this.elems.canvases[0] || !this.elems.canvases[0].length) {
            return;
        }

        this.started = true;
        var self = this,
            timeline = new TimelineMax({paused: true, onComplete: function () {
                self.permanentAnimation();
            }}),
            duration = 2,
            letters = {},
            i = 0,
            offset = 30,
            delay = 0.06;

        // get letter and its parts
        $.each(self.entities, function (key, entity) {
            // letter
            if (key.search('part') < 0) {
                if (!letters[key]) {
                    letters[key] = [];
                }
            } else {
                var lett = key.match(/(.+)-/);
                if (!letters[lett[1]]) {
                    letters[lett[1]] = [];
                }
                letters[lett[1]].push(key);
            }
        });

        // thru each letter
        $.each(letters, function (letterKey, letter) {
            var params = self.entities[letterKey].params,
                startParams = inStates[letterKey].params;

            timeline.insert([
                TweenMax.from(params, duration, {
                    x: params.x + (offset * startParams.dirX),
                    y: params.y + (offset * startParams.dirY),
                    angle: startParams.angle ? startParams.angle : params.angle,
                    scaleX: startParams.scale ? startParams.scale : params.scale,
                    scaleY: startParams.scale ? startParams.scale : params.scale
                }),
                TweenMax.from(self.entities[letterKey], duration, {
                    colorProps: {
                        color: 'rgba(255,255,255,0)'
                    }
                })
            ], duration * delay * i);

            // thru each part
            $.each(letter, function (partKey, part) {
                params = self.entities[part].params;
                timeline.insert([
                    TweenMax.from(params, duration, {
                        x: params.x + (offset * startParams.dirX),
                        y: params.y + (offset * startParams.dirY),
                        angle: startParams.angle ? startParams.angle : params.angle,
                        scaleX: startParams.scale ? startParams.scale : params.scale,
                        scaleY: startParams.scale ? startParams.scale : params.scale
                    }),
                    TweenMax.from(self.entities[part], duration, {
                        colorProps: {
                            color: 'rgba(255,255,255,0)'
                        }
                    })
                ], duration * delay * i);
            });

            i++;
        });

        timeline.play();

        return this;
    },
    permanentAnimation: function () {
        'use strict';
        var self = this;
        var entities = FRONDEVO.controls.intro.entities,
            module = FRONDEVO.controls,
            canUse = ['f', 'r', 'o', 'n', 'd', 'e', 'v', 'o2'],
            lettersState = {
                'f' : 0,
                'r' : 0,
                'o' : 0,
                'n' : 0,
                'd' : 0,
                'e' : 0,
                'v' : 0,
                'o2' : 0
            },
            duration = 5,
            yoyo = true,
            easing = Linear.easeNone,
            timelines = {},
            tempLetter = '',
            dur = duration * 100;

        function applyState(array, state){

            $.each(array, function (key, value) {
                var currentEntity = module.intro.entities[value],
                    targetEntity = state[value],
                    timeline = new TimelineMax({
                        paused: true,
                        yoyo: yoyo,
                        repeat: 1,
                        ease: easing
                    });

                $.each(currentEntity.path, function (pointKey, point) {
                    var obj = {};
                    $.each(targetEntity.path[pointKey], function (key2, value2) {
                        if (typeof value2 === 'number') {
                            obj[key2] = value2;
                        }
                    });

                    if (!TweenMax.isTweening(point)) {
                        TweenMax.to(point, duration, obj);
                    }

                });


                var obj = $.extend({}, targetEntity.params, true);
                if (!TweenMax.isTweening(currentEntity.params)) {
                    TweenMax.to(currentEntity.params, duration, obj);
                }

            });
        };
        function canUseThis(obj){
            var res = false;
            $.each(canUse, function (key, value) {
                if (obj.letter === value) {
                    res |= true;
                }
            });
            return res;
        };
        function startPlay() {
            var obj = FRONDEVO.controls.intro.getRandomLetter();

            while (canUseThis(obj[0]) === false || obj[0].letter === tempLetter) {
                obj = FRONDEVO.controls.intro.getRandomLetter();
            }
            tempLetter = obj[0].letter;

            $.each(obj, function (key, value) {

                if (canUseThis(value)) {
                    var state = parseInt(Math.random() * (states.length)) + 1;
                    while (state === lettersState[value.letter]) {
                        state = parseInt(Math.random() * (states.length)) + 1;
                    }

                    lettersState[value.letter] = state;
                    value.stateNow = state;
                    var parts = value.parts;
                    parts = [FRONDEVO.controls.intro.shuffle(parts)[0]];

                    if (states && states[state]) {
                        applyState(parts, states[state]);
                    }

                }
            });
        };
        function letsPlay() {
            $.each(timelines, function () {
                if (timeline.reversed()) {
                    this.play();
                } else {
                    this.reverse();
                }
            });
        }

        if (self.canPlay) {
            setInterval(function () {
                startPlay();
                letsPlay();
            }, dur);
        }
        startPlay();
        letsPlay();


        return this;
    },
    getRandomLetter: function (num) {
        'use strict';
        var self = this,
            array = [],
            parts = [],
            result = [];

        for (var key in self.entities) {
            if (self.entities.hasOwnProperty(key)) {
                if (key.search('part') < 0) {
                    array.push(key);
                }
            }
        }
        array = self.shuffle(array);

        if (num > array.length) {
            num = array.length
        } else if (num < 0 || !num){
            num = 1;
        }

        for (var i = 0; i < num; i++) {
            var letter = array[i];

            for (var key in self.entities) {
                if (self.entities.hasOwnProperty(key)) {
                    if (key.search(letter + '-') >= 0) {
                        parts.push(key);
                    }
                }
            }

            result.push({
                letter: letter,
                parts: parts
            });
            parts = [];
        }

        return result;
    },
    shuffle: function (o){ //v1.0
        for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
        return o;
    },
    canvasStretch: function () {
        'use strict';
        var self = this;

        self.settings.width = self.elems.canvases[0].parent().width();
        self.settings.height = self.elems.canvases[0].parent().height();
        self.elems.canvases[0].attr({
            width: self.settings.width,
            height: self.settings.height
        });

        return this;
    },
    resize: function () {
        'use strict';
        var self = this,
            options = self.settings,
            baseZone = options.baseLettersZone,
            realZone = options.realLettersZone,
            currentZone = options.actualLettersZone;

        self.canvasStretch();

        if (self.settings.width < realZone.width) {
            currentZone.ratio = self.settings.width / baseZone.width;
            currentZone.width = Math.round(realZone.width * currentZone.ratio);
            currentZone.height = Math.round(realZone.height * currentZone.ratio);
            currentZone.offset = {
                x: (options.width - currentZone.width) * 0.5 + baseZone.staticOffset.x,
                y: (options.height - currentZone.height) * 0.5 + baseZone.staticOffset.y
            };
        } else {
            currentZone.width = realZone.width;
            currentZone.height = Math.round(realZone.width * options.baseZoneRatio);
            currentZone.offset = {
                x: (options.width - currentZone.width) * 0.5 + baseZone.staticOffset.x,
                y: (options.height - currentZone.height) * 0.5 + baseZone.staticOffset.y
            };
            currentZone.ratio = currentZone.width / baseZone.width;
        }

        self.elems.canvases[0].attr({
            width: parseInt(options.width),
            height: parseInt(options.height)
        });

        return this;
    },
    drawPool: function () {
        'use strict';
        var self = this,
            options = self.settings,
            currentZone = options.actualLettersZone,
            ratio = currentZone.ratio,
            t = {},
            pool = $.extend({}, self.entitiesParts, self.entities),
            ctx = self.elems.ctxs[0],
            i = self.entities.length - 1;

        // clear before draw
        ctx.clearRect(0, 0, options.width, options.height);

        // draw each entity
        for (var value in pool) {
            if (pool.hasOwnProperty(value)) {
                if (pool[value] && pool[value].params.alpha !== 0) {
                    self.drawEntity(pool[value], value);
                }
            }
        }

        // debug
        if (options.debug) {
            ctx.save();
            ctx.beginPath();
            ctx.strokeStyle = 'rgba(255,255,0,0.1)';
            ctx.lineWidth = 1;
            ctx.translate(
                currentZone.offset.x,
                currentZone.offset.y
            );
            ctx.rect(
                0,
                0,
                currentZone.width,
                currentZone.height
            );
            ctx.stroke();
            ctx.closePath();
            ctx.restore();
        }
        return this;
    },
    drawEntity: function (entity, eName) {
        'use strict';
        var self = this,
            ctxs = self.elems.ctxs,
            ctx = ctxs[0],
            options = self.settings,
            currentZone = options.actualLettersZone,
            zonePos = {
                x: currentZone.offset.x + currentZone.width * 0.5,
                y: currentZone.offset.y + currentZone.height * 0.5
            },
            clone = $.extend({}, entity),
            params = clone.params,
            tempPos = {};

        // resize params
        clone.width *=  currentZone.ratio;
        clone.height *=  currentZone.ratio;

        if (options.debugMain) {
            if (eName.search('part') < 0) {
                ctx.fillStyle = 'rgba(255,255,255,0.5)';
                ctx.strokeStyle = 'rgba(255,255,255,0)';
            }
        } else {
            // ctx settings
            ctx.fillStyle = entity.color || '#fff';
            ctx.strokeStyle = entity.strokeColor || 'rgba(255,255,255,0)';
        }

        if (options.debugParts) {
            if (eName.search('part') > -1) {
                ctx.fillStyle = 'rgba(255,255,255,0.5)';
                ctx.strokeStyle = 'rgba(255,255,255,0)';
            }
        }


        // image type entity
        if (entity.type === 'image') {
            ctx.save();
            ctx.globalAlpha = params.alpha;
            ctx.translate(params.x * currentZone.ratio + zonePos.x, params.y * currentZone.ratio + zonePos.y);
            ctx.scale(params.scaleX, params.scaleY);
            ctx.rotate(params.angle);
            ctx.drawImage(
                clone.img,
                -clone.width * 0.5,
                -clone.height * 0.5,
                clone.width,
                clone.height
            );
            ctx.restore();

        // path type entity
        } else if (entity.type === 'path') {

            ctx.lineWidth = 2;
            ctx.save();
            ctx.globalAlpha = params.alpha;
            ctx.translate(params.x * currentZone.ratio + zonePos.x, params.y * currentZone.ratio + zonePos.y);
            ctx.scale(params.scaleX, params.scaleY);
            ctx.rotate(params.angle);

            ctx.beginPath();
            ctx.globalCompositeOperation = 'source-over';

            for (var key = 0; key <= entity.path.length - 1; key++) {
                var value = entity.path[key];
                //$.each(entity.path, function (key, value) {

                switch (value.type) {
                    case 'circle':
                        ctx.arc(
                            value.x * currentZone.ratio,
                            value.y * currentZone.ratio,
                            value.radius * currentZone.ratio,
                            value.angleStart,
                            value.angleEnd,
                            value.antiClockwise ? true : false
                        );
                        tempPos = {
                            x: value.x * currentZone.ratio,
                            y: value.y * currentZone.ratio
                        };
                        break;
                    case 'quadratic':
                        ctx.quadraticCurveTo(
                            value.x1 * currentZone.ratio,
                            value.y1 * currentZone.ratio,
                            value.x2 * currentZone.ratio,
                            value.y2 * currentZone.ratio
                        );
                        tempPos = {
                            x: value.x1 * currentZone.ratio,
                            y: value.y1 * currentZone.ratio
                        };
                    default:
                        if (key === 0) {
                            ctx.moveTo(value.x * currentZone.ratio, value.y * currentZone.ratio);
                        }
                        ctx.lineTo(value.x * currentZone.ratio, value.y * currentZone.ratio);
                        tempPos = {
                            x: value.x * currentZone.ratio,
                            y: value.y * currentZone.ratio
                        };
                }

                //});
            };
            ctx.fill();
            ctx.closePath();

            for (var key = 0; key <= entity.path.length - 1; key++) {
                var value = entity.path[key];
                //$.each(entity.path, function (key, value) {
                switch (value.type) {
                    case 'circle':
                        tempPos = {
                            x: value.x * currentZone.ratio,
                            y: value.y * currentZone.ratio
                        };
                        break;
                    case 'quadratic':
                        tempPos = {
                            x: value.x1 * currentZone.ratio,
                            y: value.y1 * currentZone.ratio
                        };
                    default:
                        tempPos = {
                            x: value.x * currentZone.ratio,
                            y: value.y * currentZone.ratio
                        };
                }

                if (options.debugMain) {
                    if (eName.search('part') < 0) {
                        ctx.save();
                        ctx.font = "normal normal 10px Tahoma";
                        ctx.textAlign = "center";
                        ctx.fillStyle = "#fff";
                        ctx.fillRect(tempPos.x - 1, tempPos.y - 1, 2, 2);
                        ctx.fillText(key, tempPos.x, tempPos.y - 4);
                        ctx.restore();
                    }
                }

                if (options.debugParts) {
                    if (eName.search('part') > -1) {
                        ctx.save();
                        ctx.font = "normal normal 10px Tahoma";
                        ctx.textAlign = "center";
                        ctx.fillStyle = "#fff";
                        ctx.fillRect(tempPos.x - 1, tempPos.y - 1, 2, 2);
                        ctx.fillText(key, tempPos.x, tempPos.y - 4);
                        ctx.restore();
                    }
                }

                //});
            };

            //ctx.drawImage(clone.img, -clone.width * 0.5, -clone.height * 0.5);
            ctx.restore();
        }

        clone = null;

        return this;
    },
    controls: function () {
        'use strict';
        var self = this;

        TweenMax.ticker.addEventListener('tick', function () {
            if (self.started) {
                self.drawPool();
            }
        });

        $(window).resize(function () {
            self.resize();
        });

        return this;
    }
};
/*
    ListScroll Class
    Version:
    ---
    Frondevo corp.
    http://frondevo.com
    Author: Andrew "Bikkuri" Kosyack
*/
function ListScroll(params) {
    'use strict';
    var self,
        $lists = $('[data-module=listscroll]'),
        lists = [],
        i = 0;

    // init for each list
    if ($lists.length) {
        for (i; i < $lists.length; i++) {
            self = this;
            self.isMobDevice = FRONDEVO ? FRONDEVO.isMobDevice : false;

            self.elems = {
                $list: $lists.eq(i),
                $items: $lists.eq(i).find('[data-listscroll-item]')
            };
            self.settings = {
                winHeight: $(window).height(),
                scrollHeight: $('body, html')[0].scrollHeight,
                scrollTop: $(document).scrollTop(),
                triggerPoints: {
                    "in": -0.2,
                    "out": 1
                }
            };
            $.extend(self.settings, params);

            self.init(params);
            lists.push(self);
        }
    } else {
        return null;
    }

    return lists;
}

ListScroll.prototype = {
    init: function () {
        'use strict';
        var self = this,
            elems = self.elems;

        self.elems.$list.removeClass('hidden');
        self.elems.$siteWrap = $('.site-wrap');
        // calculate positions
        elems.$list.data('posY', elems.$list.offset().top);

        self.matches = FRONDEVO.controls.desktop.matches;

        self.setItemHeightCof();
        self.sortItems();

        self.controls();
        return this;
    },

    sortItems: function () {
        'use strict';
        var self = this,
            elems = self.elems,
            $visible = elems.$items.filter('.visible');

        $visible.filter(':odd').addClass('odd').removeClass('even');
        $visible.filter(':even').addClass('even').removeClass('odd');

        return this;
    },

    setItemHeightCof: function () {
        'use strict';
        var self = this,
            elems = self.elems,
            options = self.settings,
            i;

        for (i = elems.$items.length - 1; i >= 0; i-- ) {
            var pos = elems.$items.eq(i).offset();
            elems.$items.eq(i).data({
                'heightCof': elems.$items.eq(i).height() / options.winHeight,
                'posY': pos.top
            });
            self.applyAction(elems.$items.eq(i));
        }
        return this;
    },

    getTriggerPos: function (posY) {
        'use strict';
        return posY / this.settings.winHeight;
    },

    applyAction: function ($item) {
        'use strict';
        //$item = this.elems.$items.eq(5);
        var self = this,
            elems = self.elems,
            options = self.settings,
            heightCof = $item.data('heightCof'),
            triggerVal = self.getTriggerPos($item.data('posY') - options.scrollTop);

        // если скроллим вниз
        if (window.scrollDelta.now > 0) {
            if (triggerVal <= options.triggerPoints.out && triggerVal >= options.triggerPoints.in - heightCof) {
                $item.addClass('active');
            } else {
                $item.removeClass('active');
            }
        // если скроллим вверх
        } else if (window.scrollDelta.now < 0) {
            if (triggerVal <= options.triggerPoints.out && triggerVal >= options.triggerPoints.in - heightCof) {
                $item.addClass('active');
            } else {
                $item.removeClass('active');
            }
        }

        return this;
    },

    controls: function () {
        'use strict';
        var self = this,
            elems = self.elems,
            options = self.settings,
            i = 0,
            listPosY = elems.$list.data('posY');

        // scroll events
        if (!self.matches) {
            TweenMax.ticker.addEventListener('tick', function () {
                options.scrollTop = self.elems.$siteWrap.scrollTop() || $(document).scrollTop();
                if (options.tempScrollTop !== options.scrollTop) {
                    // применить анимацию появления в зоне видимости
                    for (i = elems.$items.length - 1; i >= 0; i-- ) {
                        if (FRONDEVO) {
                            self.applyAction(elems.$items.eq(i));
                        }
                    }
                }
                options.tempScrollTop = options.scrollTop;
            });
        } else {
            $(window).on({
                scroll: function () {
                    options.scrollTop = $(document).scrollTop() || self.elems.$siteWrap.scrollTop();

                    // применить анимацию появления в зоне видимости
                    for (i = elems.$items.length - 1; i >= 0; i-- ) {
                        if (FRONDEVO) {
                            self.applyAction(elems.$items.eq(i));
                        }
                    }

                },
                resize: function () {
                    var i = 0;
                    self.setItemHeightCof();
                    options.scrollTop = $(document).scrollTop();
                    options.scrollHeight = $('body, html')[0].scrollHeight;

                }
            });
        }

        $(window).on('resize', function () {
            self.matches = FRONDEVO.controls.desktop.matches;
        });

        return this;
    }
};
/*
 Loader Class
 Version:
 ---
 Frondevo corp.
 http://frondevo.com
 Author: Andrew "Bikkuri" Kosyack
 */
function Loader() {
    'use strict';
    return this;
}
Loader.prototype = {
    loadImages: function (fileList, step, callback) {
        'use strict';
        var self = this,
            arrLength = fileList.length,
            result = [];

        $.each(fileList, function (key, value) {
            var _self = self.msie ? $('<img/>')[0] : new Image(),
                src = this.fileName,
                fileSize = this.fileSize;

            function ready(){
                var elem = {
                    src: $(_self).attr('src'),
                    width: $(_self)[0].naturalWidth,
                    height: $(_self)[0].naturalHeight
                };
                result.push(elem);
                arrLength--;
                if (typeof step === 'function') {
                    step(fileSize, _self, elem, key);
                }
                if (!arrLength && typeof callback === 'function') {
                    callback(result);
                }
            };
            function err(){
                var elem = {
                    src: $(_self).attr('src'),
                    width: $(_self)[0].naturalWidth,
                    height: $(_self)[0].naturalHeight
                };
                result.push(elem);
                arrLength--;
                if (typeof step === 'function') {
                    step(fileSize, _self, elem, key);
                }
                if (!arrLength && typeof callback === 'function') {
                    callback(result);
                }
            };

            src = src.replace('../img/', 'img/');
            src = src.replace('../pic/', 'pic/');

            if (typeof value === 'object') {

                $(_self).load(function () {
                    ready();
                    $(_self).remove();
                }).error(function () {
                    err();
                    $(_self).remove();
                }).attr('src', src);
            }
        });
    },

    silentLoadImages: function (fileList, step, callback, slide) {
        'use strict';
        var self = this,
            arrLength = fileList.length,
            result = [];

        $.each(fileList, function (key, value) {
            var _self = self.msie ? $('<img/>')[0] : new Image(),
                src = this.fileName,
                fileSize = this.fileSize;

            function ready(){
                arrLength--;
                if (typeof step === 'function') {
                    step();
                }
                if (!arrLength && typeof callback === 'function') {
                    callback(slide);
                }
            };
            function err(){
                arrLength--;
                if (typeof step === 'function') {
                    step();
                }
                if (!arrLength && typeof callback === 'function') {
                    callback(slide);
                }
            };

            src = src.replace('../img/', 'img/');
            src = src.replace('../pic/', 'pic/');

            if (typeof value === 'object') {
                $(_self).load(function () {
                    ready();
                    $(_self).remove();
                }).error(function () {
                    err();
                    $(_self).remove();
                }).attr('src', src);
            }
        });
    },

    objectLength: function (obj) {
        'use strict';
        var self = this,
            result = 0;

        $.each(obj, function (key, value) {
            result++;
        });

        return result;
    }
};
/*
    MainLoader Class
    Version:
    ---
    Frondevo corp.
    http://frondevo.com
    Author: Andrew "Bikkuri" Kosyack
*/

Element.prototype.animation = function () {
    var element = this,
        style = getComputedStyle(element),
        handlers = {
            promise: function (fullFill, reject) {
                var animationEnd = function (event) {
                    if (event.target === element) {
                        fullFill();
                    }
                };

                element.addEventListener('animationend', animationEnd, false);
                element.addEventListener('webkitAnimationEnd', animationEnd, false);
            }
        };

    return new Promise(handlers.promise);
};

Element.prototype.transition = function () {
    var element = this,
        style = getComputedStyle(element),
        properties,
        handlers = {
            promise: function (fullFill, reject) {
                var transitionEnd = function (event) {

                    if (event.target === element) {
                        properties = properties.replace(event.propertyName, '');

                        if (!properties.length) {
                            fullFill();
                        }

                    }

                };

                element.addEventListener('transitionend', transitionEnd, false);
                element.addEventListener('webkitTransitionEnd', transitionEnd, false);
            }
        };

    properties = style.transitionProperty;

    return new Promise(handlers.promise);
};

function MainLoader(params) {
    'use strict';
    var self = this;

    self.elems = {
        loadWrap: document.querySelector('.loading')
    };

    self.settings = {
        firstTime: true,
        firstScreenDelay: 3000
    };
    $.extend(self.settings, params);

    self.msie = navigator.userAgent.search(/msie/ig) > -1 || navigator.userAgent.search(/trident/ig) > -1;
    self.init(params);

    return this;
}


MainLoader.prototype = {
    init: function () {
        'use strict';
        var self = this,
            $elems = self.elems,
            options = self.settings;

        if (localStorage.getItem('firstTime')) {
            options.firstTime = false;
        } else {
            localStorage.setItem('firstTime', true);
        }

        FRONDEVO.controls.loader = new Loader();
        FRONDEVO.controls.intro = new Intro();
        FRONDEVO.controls.sparks = new Sparks();

        self.controls();

        window.addEventListener('load', function () {
            var wrap = $elems.loadWrap,
                icImage = wrap.querySelector('.ic-img');

            wrap.classList.add('loaded');

            FRONDEVO.controls.sparks.play();

            setTimeout(function () {
                FRONDEVO.controls.intro.inAmimation();

                if (FRONDEVO.controls.intro && FRONDEVO.controls.intro.started) {
                    FRONDEVO.controls.intro.strokes();
                }

                setTimeout(function () {

                    $.each(FRONDEVO.controls.stroke, function(key, value){
                        FRONDEVO.controls.stroke[key].play();
                    });

                }, 1000 * 0.2);

            }, 1000 * 0.5);

            wrap.transition().then(function () {
                wrap.classList.remove('loading');
                wrap.classList.add('ready');

                setTimeout(function () {
                    icImage.classList.add('visible');
                }, 1000 * 0.3);

            });

        }, false);

        return this;
    },


    load: function (callback, step) {
        'use strict';
        var self = this;

        return this;
    },

    controls: function () {
        'use strict';
        var self = this;

        return this;
    }
};
/*
    Popup Class
    Version:
    ---
    Frondevo corp.
    http://frondevo.com
    Author: Andrew "Bikkuri" Kosyack
*/
function Popup(params) {
    'use strict';
    var self = this;

    self.isMobDevice = self.isMobDevice = FRONDEVO ? FRONDEVO.controls.isMobDevice : false;
    self.elems = {
        $menu: $('.header-menu').eq(0),
        $menuItems: $('.header-menu .m-item'),
        $popup: $('.fd__popup'),
        $popupHtml: $('.pop-content').html().replace(/style=\"display: none;\"/g, ''),
        $hbMenu: $('.fd__hb-menu')
    };

    self.elems.$popup.remove();

    self.settings = {
    };

    $.extend(self.settings, params);

    self.popupCode = function (title, content, close){
        title = title ? title : '';
        content = content ? content : '';
        close = close ? close : '';
        return '<div class="fd__popup tEndElement">' +
            '    <div class="pop-wrap">' +
            '        <div class="queue-wrap queueFromTop">' +
            '            <h2 class="pop-title tEndElement queue queue1">' + title + '</h2>' +
            '        </div>' +
            '        <div class="pop-content queue-wrap queueFromBottom">' + content + '</div>' +
            '        <div title="' + close + '" class="pop-btn-close"></div>' +
            '    </div>' +
            '</div>';
    };
    self.popupMenuCode = function (content, close){
        content = content ? content : '';
        close = close ? close : '';

        return '<div class="fd__popup fd__popup_v2 tEndElement">' +
            '    <div class="pop-wrap">' + self.elems.$popupHtml + '</div>' +
            '    <div title="' + close + '" class="pop-btn-close">' +
            '    <span></span>' +
            '    </div>' +
            '</div>';
    };
    self.popups = {
    };


    self.init(params);

    return this;
}

Popup.prototype = {
    init: function () {
        'use strict';
        var self = this;

        self.controls();

        return this;
    },

    getMenuPopup: function (callback) {
        'use strict';
        var self = this,
            elems = self.elems,
            code = '<ul class="popup-menu">',
            dataCode = '';

        elems.$menuItems.each(function (key, value) {
            var obj = {
                popup: $(value).find('a, span').attr('data-popup'),
                popupTitle: $(value).find('a, span').attr('data-popup-title'),
                popupClose: $(value).find('a, span').attr('data-popup-close')
            };

            if (obj.popup) {
                dataCode = ' data-popup="' + obj.popup + '" data-popup-title="' + obj.popupTitle + '" data-popup-close="' + obj.popupClose + '"';
            }

            if ($(value).hasClass('active')) {
                code += '<li class="pm-item active queue queue' + (key + 1) + '"' + dataCode + '><span>' + $(value).text() + '</span></li>';
            } else {
                var $lnk = $(value).find('a').eq(0);
                code += '<li class="pm-item queue queue' + (key + 1) + '"' + dataCode + '><a href="' + $lnk.attr('href') + '">' + $lnk.text() + '</a></li>';
            }
        });
        code += '</ul>';
        self.popups.menu.code = code;

        if (typeof callback === 'function') {
            callback();
        }

        return this;
    },

    getPopupContent: function (obj, callback) {
        'use strict';
        var self = this;

        if (obj.popup === 'menu') {
            self.popups[obj.popup] = {
                title: obj.title,
                close: obj.close,
                popup: obj.popup
            };
            self.getMenuPopup(function () {
                if (typeof callback === 'function') {
                    callback(obj.popup);
                }
            });
        } else {
            var url = obj.url ? obj.url : 'popup/';

            /*$.ajax({
                url: url + obj.popup + '.html',
                dataType : 'html',
                complete: function (xhr, response) {
                    console.log(xhr, response);
                    self.popups[obj.popup] = {
                        title: obj.title,
                        close: obj.close,
                        popup: obj.popup,
                        code: xhr.responseText
                    };

                    if (typeof callback === 'function') {
                        callback(obj.popup);
                    }
                },
                error: function () {
                    alert('error!');
                }
            });*/
            self.popups[obj.popup] = {
                title: obj.title,
                close: obj.close,
                popup: obj.popup,
                code: self.elems.$popupHtml
            };

            if (typeof callback === 'function') {
                callback(obj.popup);
            }
        }

        return this;
    },

    openPopup: function (contentId) {
        'use strict';

        var self = this,
            $popup = {};

        switch (contentId) {
            case 'gmenu':
                $popup = $(self.popupMenuCode(self.popups[contentId].code, self.popups[contentId].close))
                break;
            default:
                $popup = $(self.popupCode(self.popups[contentId].title, self.popups[contentId].code, self.popups[contentId].close))
        }

        self.elems.$popup = $popup;
        self.elems.$popupTitleWrap = $popup.find('.pop-title').eq(0).parent();
        self.elems.$popupContent = $popup.find('.pop-wrap').eq(0);

        self.elems.$popupContent.removeClass('animate in');
        self.elems.$popupTitleWrap.removeClass('animate in');


        $('html').addClass('no-scroll');
        //$('.main-wrap').append($popup);
        $('body').append($popup);

        setTimeout(function () {
            $popup.addClass('visible');
            self.elems.$hbMenu.addClass('hidden');
            setTimeout(function () {
                /*self.elems.$popupContent.addClass('animate in');
                self.elems.$popupTitleWrap.addClass('animate in');*/
                self.elems.$popup.find('.queue-wrap').addClass('animate in');
                //self.elems.$popupTitleWrap.addClass('animate in');
            });
        }, 100);

        return this;
    },

    closePopup: function () {
        'use strict';

        var self = this,
            $title = self.elems.$popup.find('.pop-title').length ? self.elems.$popup.find('.pop-title') : self.elems.$popupContent.find('.fd__stripe').eq(0);

        self.elems.$popup.find('.queue-wrap').removeClass('in');
        /*self.elems.$popupContent.removeClass('in');
        self.elems.$popupTitleWrap.removeClass('in');*/

        $title.data('tcallback', {
            prop: 'opacity',
            callback: function () {
                self.elems.$popup.removeClass('visible');
                self.elems.$hbMenu.removeClass('hidden');
                $('html').removeClass('no-scroll');

                /*self.elems.$popupContent.removeClass('in');
                 self.elems.$popupTitleWrap.removeClass('in');*/

                // set callback after popup animation
                self.elems.$popup.data('tcallback', {
                    prop: 'opacity',
                    callback: function () {
                        self.elems.$popup.remove();
                        self.elems.$popup = null;
                    }
                });
                $title.data('tcallback', null);
            }
        });




        return this;
    },

    updateContent: function (obj) {
        'use strict';
        var self = this,
            $title = self.elems.$popup.find('.pop-title'),
            $qWrap = self.elems.$popup.find('.queue-wrap');

        $qWrap.eq(0).removeClass('in');
        $qWrap.eq(1).removeClass('in');

        // set callback after popup animation
        $title.data('tcallback', {
            prop: 'opacity',
            callback: function () {
                self.getPopupContent(obj, function () {
                    self.elems.$popupContent
                        .empty()
                        .append(self.popups[obj.popup].code);
                    $title.html(obj.title);
                    $qWrap = self.elems.$popup.find('.queue-wrap');

                    self.elems.$popupTitleWrap = self.elems.$popup.find('.pop-title').eq(0).parent();
                    self.elems.$popupContent = self.elems.$popup.find('.pop-content').eq(0);

                    $qWrap.eq(0).addClass('queueFromTop');
                    $qWrap.eq(1).addClass('queueFromBottom');

                    setTimeout(function () {
                        $qWrap.eq(0).addClass('in');
                        $qWrap.eq(1).addClass('in');
                        self.elems.$popup.find('.pop-title').data('tcallback', null);
                    }, 100);
                });
            }
        });

        return false;
    },

    createPopupObject: function (obj) {
        'use strict';
        var self = this;

        // если попап открыт
        if (!!self.elems.$popup) {
            obj.title = $obj.attr('data-popup-title');
            self.updateContent(obj);
            // если попап закрыт
        } else {
            if (self.popups[obj.popup]) {
                self.openPopup(obj.popup);
            } else {
                self.getPopupContent(obj, function (popup) {
                    self.openPopup(popup);
                });
            }
        }

        return this;
    },

    controls: function () {
        'use strict';
        var self = this,
            clickEvent = self.isMobDevice ? 'touchend MSPointerDown click' : 'click';

        $(document).on(clickEvent, '[data-popup]', function (event) {
            if (self.elems.$popup) {
                self.elems.$popup.remove();
                self.elems.$popup = null;
            }
            var $obj = $(this),
                obj = {
                    popup: $obj.attr('data-popup'),
                    title: $obj.attr('data-popup-title'),
                    close: $obj.attr('data-popup-close'),
                    url: $obj.attr('data-popup-url')
                };

            self.createPopupObject(obj);

            event.preventDefault();

        });

        $(document).on(clickEvent, '.pop-btn-close', function (event) {
            self.closePopup();
        });



        // temporary
        /*self.createPopupObject({
            popup: 'menu',
            title: 'Menu',
            close: 'Close',
            url: 'popup/'
        });*/

        return this;
    }
};
/*
    ProjectsFilter Class
    Version:
    ---
    Frondevo corp.
    http://frondevo.com
    Author: Andrew "Bikkuri" Kosyack
*/
function ProjectsFilter(params) {
    'use strict';
    var self,
        $lists = $('[data-module=projectsfilter]'),
        lists = [],
        i = 0;

    // init for each list
    if ($lists.length) {
        for (i; i < $lists.length; i++) {
            self = this;

            self.isMobDevice = self.isMobDevice = FRONDEVO ? FRONDEVO.isMobDevice : false;

            self.elems = {
                $menu: $lists.eq(i),
                $menuItems: $lists.eq(i).find('[data-filter-projects]'),
                $list: $('[data-filter-id=' + $lists.eq(i).attr('data-filter-list') + ']')
            };
            self.elems.$items = self.elems.$list.find('[data-project-type]');


            self.settings = {

            };
            $.extend(self.settings, params);

            self.init(params);
            lists.push(self);
        }
    } else {
        return null;
    }

    return lists;
}



ProjectsFilter.prototype = {
    init: function () {
        'use strict';
        var self = this,
            hash = location.hash ? location.hash.replace('#', '') : '';

        self.buildItems();

        // filter activate if it presents
        if (hash && hash !== 'all') {
            // reset hash for no jumping
            location.hash = '';
            setTimeout(function () {
                // restore hash
                location.hash = hash;
                self.getHash();
            })
        }



        self.controls();

        return this;
    },

    buildItems: function () {
        'use strict';
        var self = this,
            elems = self.elems,
            i = elems.$items.length - 1,
            totalHeight = 0,
            locHeight = 0,
            offset = 0,
            rule = function (z, scale) {
                return {
                    '-webkit-transform': 'translateY(' + z + 'px) scale('+ scale +', ' + scale + ')',
                    '-moz-transform': 'translateY(' + z + 'px) scale('+ scale +', ' + scale + ')',
                    '-ms-transform': 'translateY(' + z + 'px) scale('+ scale +', ' + scale + ')',
                    '-o-transform': 'translateY(' + z + 'px) scale('+ scale +', ' + scale + ')',
                    'transform': 'translateY(' + z + 'px) scale('+ scale +', ' + scale + ')'
                }
            };

        elems.$items.each(function (key, value) {
            $(value).css(rule($(value).height() * key, 0.4));
        });
        elems.$items.filter('.visible').each(function (key, value) {
            locHeight = $(value).height();
            offset = locHeight * key;

            $(value).css(rule(offset, 1));
            totalHeight += locHeight;
            $(value).data({
                posY: offset
            });

            if (FRONDEVO) {
                $.each(FRONDEVO.controls.listScroll, function (key2, value2) {
                    value2.sortItems();
                    value2.applyAction($(value));
                });
            }

        });

        elems.$list.css({
            height: totalHeight
        });


        return this;
    },

    triggerMenuItems: function ($btn) {
        'use strict';
        var self = this,
            elems = self.elems;

        elems.$menuItems.filter('.active').removeClass('active');
        $btn.addClass('active');

        return this;
    },

    filterBy: function (filter) {
        'use strict';
        var self = this,
            elems = self.elems;

        if (!filter || filter === 'all') {
            elems.$items
                .addClass('visible')
                .removeClass('filtered');
        } else {
            elems.$items.filter(':not([data-project-type=' + filter + '])')
                .addClass('filtered')
                .removeClass('visible');
            elems.$items.filter('[data-project-type=' + filter + ']')
                .addClass('visible')
                .removeClass('filtered');
        }

        /*var $visible = elems.$items.filter('.visible');
        elems.$items.each(function (key, value) {
            elems.$items.removeClass('item-position' + (key + 1));
        });*/

        self.buildItems();

        return this;
    },

    setHash: function (hash) {
        'use strict';
        var self = this;

        if (hash === 'all') {
            location.hash = '';
        } else {
            location.hash = hash;
        }


        return this;
    },

    getHash: function (hash) {
        'use strict';
        var self = this,
            curHash = location.hash.replace('#', '');

        if (curHash && curHash !== 'all') {
            self.triggerMenuItems($('[data-filter-projects='+ curHash +']').eq(0));
            self.filterBy(curHash);
        }

        return this;
    },

    controls: function () {
        'use strict';
        var self = this,
            clickType = self.isMobDevice ? 'touchend MSPointerDown' : 'click';

        $(document).on(clickType, '[data-filter-projects]', function (event) {
            event.preventDefault();
            var $btn = $(this),
                filter = $btn.attr('data-filter-projects');
            self.triggerMenuItems($btn);
            self.filterBy(filter);
            self.setHash(filter);
        });

        $(document).on('hashchange', function (event) {
            event.preventDefault();
        });

        return this;
    }
};
/*
    Sparks Class
    Version:
    ---
    Frondevo corp.
    http://frondevo.com
    Author: Andrew "Bikkuri" Kosyack
*/
function Sparks(params) {
    'use strict';
    var self = this;

    self.init(params);

    return this;
}



Sparks.prototype = {
    init: function (params) {
        'use strict';
        var self = this;

        self.elems = {
            $sparksWrap: $('.fd__sparks')
        };

        if (!self.elems.$sparksWrap.length) {
            return;
        }

        self.elems.$canvas = self.elems.$sparksWrap.find('canvas');

        if (!self.elems.$canvas.length) {
            return;
        }

        if (!self.params) {
            self.controls();
            self.params = params;
        }


        self.elems.ctx = self.elems.$canvas[0].getContext('2d');

        self.settings = {
            sparks: 4,
            totalSparks: 80,
            proportions: {
                'diagonal': [0, 0.9],
                'random': [1, 0.05],
                'chaos': [1, 0.05]
            },
            live: function () {
                return Math.random() * 60 + 60
                //return Math.random() * 2 + 2
            },
            alpha: function () {
                return Math.random() * 0.2 + 0.2
            },
            scale: function () {
                return Math.random() * 0.2 + 0.2
            },
            file: function () {
                return parseInt((Math.random() * (this.sparks - 0.01) + 1))
            }
        };
        $.extend(self.settings, params);

        self.stack = [];
        self.pool = [];

        self.emmiters = [
            {
                xp: 0.7,
                yp: 1,
                y0: 0,
                y1: 0,
                x0: -0.5,
                x1: 0.5,
                angle: -Math.PI * 0.15
            },
            {
                xp: 0.5,
                yp: 0.5,
                y0: 0.1,
                y1: 0.9,
                x0: 0.1,
                x1: 0.9,
                angle: 0
            }
            /*{
             xp: 0.5,
             yp: 1,
             y0: 0,
             y1: 0,
             x0: -300,
             x1: 300,
             angle: 0
             }*/
        ];

        self.resize();



        return this;
    },

    createSparks: function () {
        'use strict';
        var self = this,
            isAntiCache = false,
            getAntiCache = function () {
                if (isAntiCache) {
                    return '?' + new Date().getTime();
                } else {
                    return '';
                }
            };

        $.each(self.settings.proportions, function (key, value) {
            for (var i = 0; i < Math.round(self.settings.totalSparks * value[1]); i++) {
                var scale = self.settings.scale();
                self.addEntity(
                    {
                        type: 'image',
                        char: key,
                        emmiterNum: value[0],
                        img: $(new Image()).attr('src', 'pic/sparks/spark'+ self.settings.file() + '.png' + getAntiCache())[0],
                        width: 47,
                        height: 47,
                        x: 0,
                        y: 0,
                        angle: 0,
                        alpha: 0,
                        scaleX: scale,
                        scaleY: scale,
                        live: self.settings.live()
                    }
                );
            }
        });

        return this;
    },
    resize: function () {
        'use strict';
        var self = this,
            elems = self.elems,
            options = self.settings,
            offset = 50,
            newSize = {
                width: elems.$sparksWrap.width(),
                height: elems.$sparksWrap.height()
            };
        self.firstBirth = true;
        elems.$canvas.attr(newSize);
        options.width = newSize.width;
        options.height = newSize.height;
        options.center = {
            x: options.width * 0.5,
            y: options.height * 0.5,
            angle: 0
        };
        options.border = {
            x0: 0 - offset,
            y0: 0 - offset,
            x1: options.width + offset,
            y1: options.height + offset,
            angle: 0
        };

        $.each(self.emmiters, function (key, value) {
            value.x = newSize.width * value.xp;
            value.y = newSize.height * value.yp;
            value.x0 = newSize.width * value.x0;
            value.y0 = newSize.height * value.y0;
            value.x1 = newSize.width * value.x1;
            value.y1 = newSize.height * value.y1;
        });

        return this;
    },
    play: function () {
        'use strict';

        var self = this;

        if (!self.elems.$sparksWrap.length) {
            return;
        }

        self.createSparks();

        self.started = true;
        $.each(self.stack, function (key, value) {
            self.pushToPool(value);
        });
        self.firstBirth = false;

        return this;
    },

    chargeEntity: function (entity) {
        var self = this,
            options = self.settings,
            progress = self.firstBirth ? 0.5 : 0,
            duration = self.firstBirth ? entity.live * 2 : entity.live,
            dirCof = 0.25,
            diagonal = Math.sqrt(Math.pow(options.width, 2) + Math.pow(options.height, 2)),
            dur = [],
            dir = Math.random() * Math.PI * dirCof - Math.PI * dirCof * 0.5,
            target = {
                x: 0,
                y: -Math.random() * (diagonal * 0.5 + diagonal)
            },
            middle = {
                x: Math.random() * 500 - 250,
                y: target.y * 0.5
            },
            bezier = {
                //type: "soft",
                curviness: 0.5,
                values:[{
                    x: 0,
                    y: 0
                }, {
                    x: middle.x,
                    y: middle.y
                }, {
                    x: target.x,
                    y: target.y
                }]
            };

        entity.vec = dir;
        entity.char = entity.char ? entity.char : '';

        TweenMax.killTweensOf(entity);
        if (self.firstBirth) {
            dur = [duration * 2, duration * 0.5];
        } else {
            dur = [duration, duration * 0.5];
        }

        switch (entity.char) {
            case 'chaos':
                entity.vec = 0;

                var vals = [];
                for (var i = 0; i < 4; i++) {
                    vals.push({
                        x: Math.random() * options.width,
                        y: Math.random() * options.height
                    });
                }

                TweenMax.to(entity, dur[0], {
                    bezier: {
                        type: 'cubic',
                        //curviness: 0.5,
                        values: vals
                    },
                    live: 0,
                    ease: Linear.easeNone
                }).progress(progress);
                break;
            case 'random':
                entity.vec = 0;
                TweenMax.to(entity, dur[0], {
                    x: Math.random() * options.width,
                    y: Math.random() * options.height,
                    live: 0,
                    ease: Linear.easeNone
                }).progress(progress);

                break;
            // diagonal
            default:
                TweenMax.to(entity, dur[0], {
                    bezier: bezier,
                    live: 0,
                    ease: Linear.easeNone
                }).progress(progress);
        }

        TweenMax.fromTo(entity, dur[1], {
            alpha: 0,
            yoyo: true,
            repeat: 1
        }, {
            alpha: options.alpha(),
            yoyo: true,
            repeat: 1,
            ease: Linear.easeNone
        }).progress(progress);


        return this;
    },
    addEntity: function (entity) {
        'use strict';
        var self = this,
            options = self.settings;

        entity.cache = $.extend({}, entity);

        self.resetEntity(entity);

        self.stack.push(entity);

        self.chargeEntity(entity);

        return this;
    },

    resetEntity: function (entity) {
        'use strict';
        var self = this,
            options = self.settings,
            emmiter = typeof entity.emmiterNum === 'number' ? self.emmiters[entity.emmiterNum] : null;

        if (entity.cache) {
            $.extend(entity, entity.cache);
        }
        if (emmiter) {
            var xHalf = (emmiter.x1 - emmiter.x0) * 0.5,
                yHalf = (emmiter.y1 - emmiter.y0) * 0.5;
            entity.emmiter = {
                x: Math.random() * (emmiter.x1 - emmiter.x0) - xHalf + emmiter.x,
                y: Math.random() * (emmiter.y1 - emmiter.y0) - yHalf + emmiter.y,
                angle: emmiter.angle
            };

        } else {
            entity.emmiter = $.extend({}, options.center);
        }

        entity.deltaTime = 0;
        entity.progress = 0;

        self.chargeEntity(entity);

        return this;
    },

    pushToPool: function(entity){
        'use strict';
        var self = this,
            totalDuration = 0;

        entity.startTime = new Date().getTime();
        entity.deltaTime = 0;

        self.pool.push(entity);

        if (!entity.onBirthTriggered) {
            if (typeof entity.onBirth === 'function') {
                entity.onBirth({
                    entity: self.elems.$canvas[0]
                });
                entity.onBirthTriggered = true;
            }
        }

        return this;
    },
    /*removeFromPool: function (index) {
        'use strict';
        var self = this,
            obj = self.pool[index];

        if (self.pool.length) {
            setTimeout(function () {
                self.pool.splice(index, 1);
            }, self.pool[index].duration * 2);
        }

        if (!self.pool[index].onEndTriggered) {
            if (typeof self.pool[index].onEnd === 'function') {
                self.pool[index].onEnd({
                    entity: self.elems.$canvas
                });
                self.pool[index].onEndTriggered = true;
            }
        }

        return this;
    },*/
    drawPool: function () {
        'use strict';
        var self = this,
            options = self.settings,
            pool = self.pool,
            ctx = self.elems.ctx,
            isOut = false,
            curPos = {
                x: 0,
                y: 0
            },
            offset = 50;


        // clear before draw
        ctx.clearRect(0, 0, options.width, options.height);
        // draw each entity
        for (var value = pool.length - 1; value >= 0; value--) {
            curPos.x = pool[value].x +pool[value].emmiter.x;
            curPos.y = pool[value].y +pool[value].emmiter.y;
            isOut = (curPos.x > options.border.x1 || curPos.y > options.border.y1 || curPos.x < options.border.x0 || curPos.y < options.border.y0);
            //console.log(pool[0].live, isOut);
            if (pool[value].live <= 0 || isOut) {
                self.resetEntity(pool[value]);
            } else if (pool[value] && pool[value].alpha !== 0) {
                self.drawEntity(pool[value], value);
            }
        }

        return this;
    },
    drawEntity: function (entity, idx) {
        'use strict';
        var self = this,
            elems = self.elems,
            ctx = elems.ctx,
            options = self.settings,
            clone = $.extend({}, entity),
            params = clone;

        // image type entity
        if (entity.type === 'image') {
            ctx.save();
            ctx.globalAlpha = params.alpha;
            ctx.translate(entity.emmiter.x, entity.emmiter.y);
            ctx.rotate(entity.emmiter.angle + entity.vec);
            //ctx.translate(params.x + entity.emmiter.x, params.y + entity.emmiter.y);
            ctx.translate(params.x, params.y);
            ctx.scale(params.scaleX, params.scaleY);
            ctx.rotate(params.angle);
            ctx.drawImage(
                clone.img,
                -clone.width * 0.5,
                -clone.height * 0.5,
                clone.width,
                clone.height
            );
            ctx.restore();
        }

        return this;
    },
    controls: function () {
        'use strict';
        var self = this;

        TweenMax.ticker.addEventListener('tick', function () {
            if (self.started) {
                self.drawPool();
            }
        });

        $(window).on({
            resize: function () {
                clearTimeout(self.resizeTimeout);
                self.resizeTimeout = setTimeout(function () {
                    /*var pool = self.pool;
                    for (var value = pool.length - 1; value >= 0; value--) {
                        self.resetEntity(pool[value]);
                    }*/
                    self.init(self.params);
                    self.play();
                }, 200);
            }
        });

        return this;
    }
};
/*
    Stroke Class
    Version:
    ---
    Frondevo corp.
    http://frondevo.com
    Author: Andrew "Bikkuri" Kosyack
*/
function Stroke(params) {
    'use strict';
    var self = this;

    self.elems = {
        $canvas: $(params.element) || $('#stroke'),
        $buffer: $('<canvas></canvas>'),
        $buffer2: $('<canvas></canvas>')
    };

    if (!self.elems.$canvas.length) {
        self.elems = null;
        return false;
    }

    self.elems.ctx = self.elems.$canvas[0].getContext('2d');
    self.elems.bufferCtx = self.elems.$buffer[0].getContext('2d');
    self.elems.bufferCtx2 = self.elems.$buffer2[0].getContext('2d');

    self.settings = {
        width: self.elems.$canvas.parent().outerWidth(),
        height: self.elems.$canvas.parent().height(),
        strokeAlpha: 0.9,
        fillColor: '#ffffff',
        strokeColor: '#ffffff',
        lineWidth: 3
    };
    $.extend(self.settings, params);

    self.init(params);

    return this;
}



Stroke.prototype = {
    init: function () {
        'use strict';
        var self = this,
            elems = self.elems,
            options = self.settings;

        // fit strokes
        /*$('[data-stroke]').each(function (key, value) {
            $(value).attr({
                width: $(value).parent().width(),
                height: $(value).parent().height()
            });
        });*/

        self.resize();

        self.pool = [];
        self.stack = [];

        self.controls();

        return this;
    },
    resize: function () {
        'use strict';
        var self = this,
            elems = self.elems,
            options = self.settings;

        options.width = self.elems.$canvas.parent().outerWidth();
        options.height = self.elems.$canvas.parent().outerHeight();

            $('[data-stroke]').each(function (key, value) {
            $(value).attr({
                width: options.width,
                height: options.height
            });
        });
        elems.$canvas.attr({
            width: options.width,
            height: options.height
        });
        elems.$buffer.attr({
            width: options.width || elems.$canvas.attr('width'),
            height: options.height || elems.$canvas.attr('height')
        });
        elems.$buffer2.attr({
            width: options.width || elems.$canvas.attr('width'),
            height: options.height || elems.$canvas.attr('height')
        });

        return this;
    },
    addEntity: function (entity) {
        'use strict';
        var self = this;

        entity.pos = {
            x: self.elems.$canvas.width() * 0.5,
            y: self.elems.$canvas.height() * 0.5
        };
        entity.size = {
            width: self.elems.$canvas.width(),
            height: self.elems.$canvas.height()
        };
        entity.deltaTime = 0;

        // count total width
        var totalWidth = 0;
        $.each(entity.pathes, function (entKey, pathesValue) {

            switch (pathesValue.type) {
                case 'line':
                    $.each(pathesValue.path, function (pathKey, pathValue) {
                        pathValue.x0 *= entity.size.width;
                        pathValue.x1 *= entity.size.width;
                        pathValue.y0 *= entity.size.height;
                        pathValue.y1 *= entity.size.height;

                        var katet1 = Math.pow(Math.abs(pathValue.x1 - pathValue.x0), 2),
                            katet2 = Math.pow(Math.abs(pathValue.y1 - pathValue.y0), 2),
                            hypo = Math.sqrt(katet1 + katet2);
                        totalWidth += hypo;
                        // extend starts params
                        $.extend(pathValue, {
                            completed: false
                        });

                    });
                    break;
                default:
            }
        });

        // extend starts params
        $.extend(entity, {
            progress: 0
        });

        // count duration
        $.each(entity.pathes, function (entKey, pathesValue) {
            switch (pathesValue.type) {
                case 'line':
                    $.each(pathesValue.path, function (pathKey, pathValue) {
                        var katet1 = Math.pow(Math.abs(pathValue.x1 - pathValue.x0), 2),
                            katet2 = Math.pow(Math.abs(pathValue.y1 - pathValue.y0), 2),
                            hypo = Math.sqrt(katet1 + katet2),
                            perc = hypo / totalWidth;
                        pathValue.duration = perc * entity.duration * entity.pathes.length;
                    });

                    break;
                default:
            }
            self.stack.push(entity);
            //self.pushToPool(entity);
        });

        return this;
    },
    play: function () {
        'use strict';
        var self = this;

        $.each(self.stack, function (key, value) {
            self.pushToPool(value);
        });

        return this;
    },
    stop: function () {
        'use strict';
        var self = this;

        $.each(self.pool, function (key, value) {
            value.completed = true;
        });

        return this;
    },
    pushToPool: function(entity){
        'use strict';
        var self = this,
            totalDuration = 0;

        entity.startTime = new Date().getTime();
        entity.deltaTime = 0;

        self.pool.push(entity);

        if (!entity.onStartTriggered) {
            if (typeof entity.onStart === 'function') {
                entity.onStart({
                    entity: self.elems.$canvas
                });
                entity.onStartTriggered = true;
            }
        }

        return this;
    },
    removeFromPool: function (index) {
        'use strict';
        var self = this,
            obj = self.pool[index];

        if (self.pool.length) {
            setTimeout(function () {
                self.pool.splice(index, 1);
            }, self.pool[index].duration * 2);
        }

        if (!self.pool[index].onEndTriggered) {
            if (typeof self.pool[index].onEnd === 'function') {
                self.pool[index].onEnd({
                    entity: self.elems.$canvas
                });
                self.pool[index].onEndTriggered = true;
            }
        }

        return this;
    },
    resetEntity: function (entity) {
        'use strict';
        var self = this,
            obj = entity;

        $.each(entity.pathes, function (entKey, pathesValue) {
            $.each(pathesValue.path, function (pathKey, pathValue) {
                // extend starts params
                $.extend(pathValue, {
                    completed: false,
                    progress: 0,
                    startTime: 0,
                    tempX: 0,
                    tempY: 0,
                    deltaTime: 0
                });

            });
        });

        return this;
    },
    drawPool: function () {
        'use strict';
        var self = this,
            i = 0,
            j = 0,
            entity,
            alpha = 1;

        self.elems.bufferCtx.clearRect(0, 0, self.settings.width, self.settings.height);

        for (i = self.pool.length - 1; i >= 0; i-- ) {
            entity = self.pool[i];
            entity.reseted = false;
            entity.deltaTime = new Date().getTime() - entity.startTime;
            entity.progress = entity.deltaTime / entity.duration;

            if (!entity.completed) {
                for (j = 0; j <= self.pool[i].pathes.length - 1; j++ ) {
                    self.draw(self.pool[i], self.pool[i].pathes[j]);
                };
                // check entity delta time
                /*if (entity.onTimePoint >= 0 && !entity.onTimeTriggered) {
                    if (entity.deltaTime >= entity.onTimePoint * entity.duration && typeof entity.onTime === 'function') {
                        entity.onTime({
                            entity: self.elems.$canvas
                        });
                        entity.onTimeTriggered = true;
                    }
                }*/
            } else {
                if (self.pool.length) {
                    if (entity.loop) {
                        self.resetEntity(entity);
                        entity.reseted = true;
                    } else {
                        self.removeFromPool(i);
                    }

                }
            }
            alpha = self.settings.strokeAlpha;
        }

        //self.elems.bufferCtx2.clearRect(0, 0, self.settings.width, self.settings.height);
        self.elems.bufferCtx2.drawImage(self.elems.$buffer[0], 0, 0);

        self.elems.ctx.clearRect(0, 0, self.settings.width, self.settings.height);
        self.elems.ctx.globalAlpha = alpha;
        self.elems.ctx.drawImage(self.elems.$buffer2[0], 0, 0);

        self.elems.bufferCtx2.clearRect(0, 0, self.settings.width, self.settings.height);
        self.elems.bufferCtx2.drawImage(self.elems.$canvas[0], 0, 0);

        //self.elems.ctx.clearRect(0, 0, self.settings.width, self.settings.height);
        //self.elems.ctx.drawImage(self.elems.$buffer2[0], 0, 0);


        return this;
    },
    draw: function (entity, pathes) {
        'use strict';
        var self = this,
            elems = self.elems,
            options = self.settings,
            ctx = elems.ctx,
            bufferCtx = elems.bufferCtx,
            bufferCtx2 = elems.bufferCtx2,
            path,
            reset = false,
            halfSize = {
                x: entity.size.width * 0.5,
                y: entity.size.height * 0.5
            },
            i = 0;


        for (i = 0; i <= pathes.path.length - 1; i++ ) {
            path = pathes.path[i];

            // если путь не отрисован
            if (!path.completed) {
                if (!path.startTime) {
                    path.startTime = new Date().getTime();
                }
                // если время отрисовки закончилось - путь отрисован
                if (path.deltaTime >= path.duration) {
                    path.completed = true;
                    path.deltaTime = path.duration;
                }
                path.deltaTime = new Date().getTime() - path.startTime;
                //entity.deltaTime += path.deltaTime;

                // не проверяем следующие
                break;
            // если все пути отрисованы
            } else {
                path.deltaTime = new Date().getTime() - path.startTime;
                entity.deltaTime += path.deltaTime;

                if (i === pathes.path.length - 1) {
                    //path = entity.path[i];
                    // фигура готова
                    if (entity.loop) {
                        self.resetEntity(entity);
                    } else {
                        entity.completed = true;
                    }
                }
            }
        }
        if (!entity.reseted) {
            path.progress = path.deltaTime / path.duration;
            path.deltaX = Math.ceil((path.x1 - path.x0) * path.progress + path.x0);
            path.deltaY = Math.ceil((path.y1 - path.y0) * path.progress + path.y0);

            if (!path.tempX) {
                path.tempX = path.x0;
            }
            if (!path.tempY) {
                path.tempY = path.y0;
            }

            self.tempPos = {
                x: path.deltaX,
                y: path.deltaY,
                dx: entity.pos.x - halfSize.x,
                dy: entity.pos.y - halfSize.y
            };

            bufferCtx.fillStyle = pathes.fillColor || entity.fillColor || self.settings.fillColor;
            bufferCtx.strokeStyle = pathes.strokeColor || entity.strokeColor || self.settings.strokeColor;
            bufferCtx.lineWidth = pathes.lineWidth || entity.lineWidth || self.settings.lineWidth;

            bufferCtx.beginPath();
            bufferCtx.save();
                //bufferCtx.globalAlpha = 0.5;
                bufferCtx.translate(entity.pos.x - halfSize.x, entity.pos.y - halfSize.y);
                bufferCtx.moveTo(path.tempX, path.tempY);
                bufferCtx.lineTo(path.deltaX, path.deltaY);
                bufferCtx.stroke();
            bufferCtx.restore();
            bufferCtx.closePath();


            path.tempX = path.deltaX;
            path.tempY = path.deltaY;
        }

        return this;
    },
    controls: function () {
        'use strict';
        var self = this;

        TweenMax.ticker.addEventListener('tick', function () {
            if (self.pool.length) {
                self.drawPool();
            }
        });



        var resizeTimeout;
        $(window).on({
            resize: function () {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function () {
                    self.resize();
                }, 1000);
            }/*,
            orientationchange: function () {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function () {
                    self.resize();
                }, 1000);
            }*/
        });



        return this;
    }
};
/*
 FDWorkPreview Class
 Version:
 ---
 Frondevo corp.
 http://frondevo.com
 Author: Andrew "Bikkuri" Kosyack
 */
function FDWorkPreview(params) {
    'use strict';
    var self = this;

    self.elems = {
        $work: $('[data-fd-work]'),
        $iframe: $('[data-fd-iframe]'),
        $title: $('[data-fd-project-title]'),
        $features: $('[data-fd-project-features]'),
        $pager: $('[data-fd-project-pager]'),
        $view: $('[data-fd-works-view]')
    };

    self.lang = $('html').attr('lang') || 'en';

    self.translates = {
        menu: {
            page: {ru: 'Веб страница', ua: 'Веб сторінка', en: 'Web Page'},
            html: {ru: 'HTML', ua: 'HTML', en: 'HTML'},
            css: {ru: 'CSS', ua: 'CSS', en: 'CSS'},
            js: {ru: 'JavaScript', ua: 'JavaScript', en: 'JavaScript'}
        }
    };

    self.settings = {
        url: 'page'
    };
    $.extend(self.settings, params);

    self.workUrl = self.elems.$work.attr('data-fd-work-url');

    console.log(self.workUrl);
    if (self.workUrl) {
        self.getWorkData(self.workUrl, function () {
            //if (self.elems.$iframe.length) {
                self.init(params);
            //}
        });
    } else {

    }

    return this;
}

FDWorkPreview.prototype = {
    init: function () {
        var self = this;

        hljs.configure({
            tabReplace: '    '
        });

        self.elems.$iframe.attr('src', self.workUrl);

        if (self.projectData) {
            self.fillProjectData();
        }

        self.controls();

        return this;
    },
    fillProjectData: function () {
        var self = this,
            url = location.search,
            res = {};

        // set current page
        if (url) {
            var params = url.replace(/\?/ig, '').split('&');
            $.each(params, function (key, value) {
                var temp = value.split('=');
                res[temp[0]] = temp[1];
            });
        }
        if (res.page && res.page < self.projectData.pages.length) {
            self.currentPage = parseInt(res.page);
        } else {
            self.currentPage = 0;
        }

        // set current page set
        self.currentPageSet = self.projectData.pages[self.currentPage];

        // fill up title
        self.elems.$title.html(self.projectData.title[self.lang]);

        // fill up features
        $.each(self.projectData.pages, function (key, value) {
            if (value.data && self.currentPage === key) {
                $.each(value.data, function (key2, value2) {
                    var className = 'm-item';
                    if (self.translates.menu[key2]) {
                        switch (key2) {
                            case "page":
                                className += ' active';
                                self.currentFeature = key2;
                                break;
                            default:
                        }
                        self.elems.$features.append('<li class="' + className + '"><a href="' + value2 + '" data-fd-work-link="'  +  key2 + '">' + self.translates.menu[key2][self.lang] + '</a></li>');
                    }

                    self.createView(key2);

                });
            }
        });

        // fill up pager
        if (self.projectData.pages.length > 1) {
            var $prevItem = self.elems.$pager.children().eq(0),
                $nextItem = self.elems.$pager.children().eq(1),
                prevUrl = location.href,
                nextUrl = location.href,
                page = self.settings.url;

            // if search string attendee
            if (location.search) {
                prevUrl = location.href.replace(/\?.*/ig, '?' + page + '=' + (self.currentPage <= 0 ? self.currentPage : self.currentPage - 1));
                nextUrl = location.href.replace(/\?.*/ig, '?' + page + '=' + (self.currentPage >= self.projectData.pages.length - 1 ? self.projectData.pages.length - 1 : self.currentPage + 1));
            } else {
                prevUrl = location.href + '?' + page + '=' + (self.currentPage <= 0 ? self.currentPage : self.currentPage - 1);
                nextUrl = location.href + '?' + page + '=' + (self.currentPage >= self.projectData.pages.length - 1 ? self.projectData.pages.length - 1 : self.currentPage + 1);
            }

            if (self.currentPage <= 0) {
                $prevItem
                    .addClass('active')
                    .html('<span>' + $prevItem.children().html() + '</span>');
                $nextItem
                    .removeClass('active')
                    .html('<a href="' + nextUrl + '">' + $nextItem.children().html() + '</a>')
            } else if (self.currentPage >= self.projectData.pages.length - 1) {
                $nextItem
                    .addClass('active')
                    .html('<span>' + $nextItem.children().html() + '</span>');
                $prevItem
                    .removeClass('active')
                    .html('<a href="' + prevUrl + '">' + $prevItem.children().html() + '</a>');
            } else {
                $nextItem
                    .removeClass('active')
                    .html('<a href="' + nextUrl + '">' + $nextItem.children().html() + '</a>')
                $prevItem
                    .removeClass('active')
                    .html('<a href="' + prevUrl + '">' + $prevItem.children().html() + '</a>');
            }

        } else {
            self.elems.$pager.remove();
        }

        // set active view
        $('[data-fd-works-code-wrap=' + self.currentFeature + ']').addClass('active');

        return this;
    },
    createView: function (view) {
        var self = this;

        switch (view) {
            case 'page':
                self.elems.$view.append('<div class="screens-item" data-fd-works-code-wrap="page"><iframe class="work-frame" src="' + self.workUrl + self.currentPageSet.data[view] + '" data-fd-iframe></iframe></div>');
                break;
            case 'html':
                fetch(self.workUrl + self.currentPageSet.data[view], {
                    method: 'get',
                    credentials: 'include'
                }).then(function (response) {
                    return response.text()
                }).then(function (text) {
                    var res = text.replace(/</ig, '&lt;').replace(/>/ig, '&gt;'),
                        $code = self.elems.$view.find('[data-fd-works-code-html]');
                    $code.html(res);
                    hljs.initHighlighting.called = false;
                    hljs.configure({
                        tabReplace: '    '
                    });
                    hljs.initHighlighting($code);
                }).catch(function (error) {
                    console.log(error);
                });

                self.elems.$view.append('<div class="screens-item" data-fd-works-code-wrap="html"><div class="work-frame"><pre><code class="html" data-fd-works-code-html></code></pre></div></div>');
                break;
            case 'css':
                fetch(self.workUrl + self.currentPageSet.data[view], {
                    method: 'get',
                    credentials: 'include'
                }).then(function (response) {
                    return response.text()
                }).then(function (text) {
                    var res = text.replace(/</ig, '&lt;').replace(/>/ig, '&gt;'),
                        $code = self.elems.$view.find('[data-fd-works-code-css]');
                    $code.html(res);
                    hljs.initHighlighting.called = false;
                    hljs.configure({
                        tabReplace: '    '
                    });
                    hljs.initHighlighting($code);
                }).catch(function (error) {
                    console.log(error);
                });

                self.elems.$view.append('<div class="screens-item" data-fd-works-code-wrap="css"><div class="work-frame"><pre><code class="css" data-fd-works-code-css></code></pre></div></div>');
                break;
            case 'js':
                fetch(self.workUrl + self.currentPageSet.data[view], {
                    method: 'get',
                    credentials: 'include'
                }).then(function (response) {
                    return response.text()
                }).then(function (text) {
                    var res = text.replace(/</ig, '&lt;').replace(/>/ig, '&gt;'),
                        $code = self.elems.$view.find('[data-fd-works-code-js]');
                    $code.html(res);
                    hljs.initHighlighting.called = false;
                    hljs.configure({
                        tabReplace: '    '
                    });
                    hljs.initHighlighting($code);

                }).catch(function (error) {
                    console.log(error);
                });

                self.elems.$view.append('<div class="screens-item" data-fd-works-code-wrap="js"><div class="work-frame"><pre><code class="js" data-fd-works-code-js></code></pre></div></div>');
                break;
            default:
        }

        return this;
    },
    getWorkData: function (url, callback) {
        var self = this;

        fetch(url + 'project.json', {
            method: 'get',
            credentials: 'include',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(function (response) {
            return response.json()
        }).then(function (json) {
            self.projectData = json;
            if (typeof callback === 'function') {
                callback();
            }
        })
        .catch(function (error) {
            console.log(error);
        });

        return this;
    },
    autoResize: function(iframe){
        var iFrameID = iframe;
        if(iFrameID) {
            // here you can make the height, I delete it first, then I make it again
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
            console.log(iFrameID.contentWindow.document.body.scrollHeight);
        }
    },
    controls: function () {
        var self = this;

        $(document).on('click', '[data-fd-work-link]', function (event) {
            event.preventDefault();

            if (!$(this).hasClass('active')) {
                var $item = $(this).parents('li').eq(0),
                    id = $(this).attr('data-fd-work-link'),
                    $view = $('[data-fd-works-code-wrap=' + id + ']');

                self.elems.$features.find('li').removeClass('active');
                $item.addClass('active');

                self.elems.$view.find('[data-fd-works-code-wrap]').removeClass('active');
                $view.addClass('active');
            }

        });

        return this;
    }
};

$(document).ready(function () {
    new FDWorkPreview();
});

/*
 FDWorks Class
 Version:
 ---
 Frondevo corp.
 http://frondevo.com
 Author: Andrew "Bikkuri" Kosyack
 */
function FDWorks(params) {
    'use strict';
    var self = this;

    self.elems = {
        $workList: $('[data-fd-works-menu-list]')
    };
    self.id = self.elems.$workList.attr('data-fd-works-menu-list');
    self.elems.$works = $('[data-fd-works-list=' + self.id + ']');
    self.elems.$static = self.elems.$works.find('[data-fd-static-works]');
    self.settings = {
    };
    $.extend(self.settings, params);

    self.action = self.elems.$workList.attr('data-fd-works-action');

    self.init(params);

    return this;
}



FDWorks.prototype = {
    init: function () {
        var self = this;

        self.controls();


        return this;
    },
    replaceWorks: function (json) {
        var self = this,
            $clone,
            $dynamic = {},
            $items = self.elems.$static.find('li'),
            counter = $items.length;

        self.locked = true;

        function createLists(json){
            var code = '<div class="dynamic_works" data-fd-dynamic-works>';
            $.each(json, function (key, value) {
                code += '<ul>';
                $.each(value, function (key2, value2) {
                    var items = '';

                    $.each(value2.items, function (itemKey, itemVal) {
                        items += '<span>' + itemVal + '</span>';
                    });

                    code += '<li class="tEndElement2" data-fd-works-item>' +
                    '   <a href="' + value2.href + '">' +
                    '       <img src="' + value2.img + '" alt=""/>' +
                    '       <div>' +
                    '           <div class="our-works__descr">' + items + '</div>' +
                    '       </div>' +
                    '   </a>' +
                    '</li>';
                });
                code += '</ul>';
            });

            return code + '</div>';
        };
        $clone = createLists(json);
        self.elems.$works.append($clone);

        // add hide state
        self.elems.$static.addClass('fd_work_list_hide');


        // hide items
        $items.each(function (key, value) {
            var scale = Math.random() * 0.2 + 0.7,
                move = 100,
                deg = [Math.random() * 90 - 45, Math.random() * 90 - 45, Math.random() * 90 - 45];

            $(value).css({
                'opacity': 0,
                'transform': 'scale(' + scale + ', ' + scale + ') translate3d(' + (Math.random() * move - move * 0.5) + 'px, ' + (Math.random() * move - move * 0.5) + 'px, ' + (Math.random() * move - move * 0.5) + 'px) rotateX(' + deg[0] + 'deg) rotateY(' + deg[1] + 'deg) rotateZ(' + deg[2] + 'deg)'
            });

            $(value).data('tcallback', {
                prop: 'opacity',
                callback: function () {
                    counter--;
                }
            });
        });

        // clean list
        function final(){
            var $new = $dynamic.clone(true);
            self.elems.$works.removeClass('fd_work_list_show');
            self.locked = false;

            self.elems.$static.remove();
            $new
                .removeAttr('data-fd-dynamic-works').attr('data-fd-static-works', '')
                .removeAttr('style')
                .attr({
                    class: 'static_works'
                });
            $dynamic.replaceWith($new);
            self.elems.$static = $new;

            $dynamic.find('li').removeAttr('style');

            /*$dynamic
                .removeAttr('data-fd-dynamic-works').attr('data-fd-static-works', '')
                .removeAttr('style');
            self.elems.$static.replaceWith($dynamic.clone());
            self.elems.$static = self.elems.$works.find('[data-fd-static-works]');
            self.elems.$static.attr({
                class: 'static_works'
            });
            $dynamic.remove();*/
        }
        // finish step
        function nextStep(){
            var $items2 = self.elems.$works.find('[data-fd-dynamic-works] li'),
                counter2 = $items2.length;


            $dynamic = self.elems.$works.find('[data-fd-dynamic-works]');

            $dynamic.show().css({
                width: self.elems.$static.width(),
                top: self.elems.$static.position().top + 10,
                left: self.elems.$static.position().left
            });
            $items2 = $dynamic.find('li');

            // insert new items
            //self.elems.$works.html($clone);

            //self.elems.$works.removeClass('fd_work_list_hide');


            //$items2 = self.elems.$works.find('li');

            // show items
            $items2.each(function (key, value) {
                var scale = Math.random() * 1 + 1,
                    move = 100,
                    deg = [Math.random() * 90 - 45, Math.random() * 90 - 45, Math.random() * 90 - 45];

                $(value).css({
                    'opacity': 0,
                    'transform': 'scale(' + scale + ', ' + scale + ') translate3d(' + (Math.random() * move - move * 0.5) + 'px, ' + (Math.random() * move - move * 0.5) + 'px, ' + (Math.random() * move - move * 0.5) + 'px)  rotateX(' + deg[0] + 'deg) rotateY(' + deg[1] + 'deg) rotateZ(' + deg[2] + 'deg)'
                });

                $(value).data('tcallback', {
                    prop: 'opacity',
                    callback: function () {
                        counter2--;

                        //$(value).removeAttr('style');
                        if (counter2 === 0 && counter === 0) {
                            final();
                        }
                    }
                });
            });
            //$dynamic.addClass('fd_work_list_hide');
            // put items

            // change state to show

            setTimeout(function () {
                $dynamic.addClass('fd_work_list_show');
                setTimeout(function () {
                    $items2.css({
                        'opacity': 1,
                        'transform': 'scale(1,1) translate3d(0,0,0)'
                    });
                }, 100);
            }, 100);
        };

        /*$items.data('tcallback', {
            prop: 'opacity',
            callback: function () {
                counter--;
                if (counter === 0) {
                    nextStep();
                }
            }
        });*/
        setTimeout(function () {
            nextStep();
        }, 100);


        return this;
    },
    setActive: function ($item) {
        var self = this,
            $list = $item.parents('[data-fd-works-menu-list]').eq(0),
            $items = $list.find('[data-fd-works-menu-item]');

        $items.filter('.active').removeClass('active');
        $item.addClass('active');

        return this;
    },
    getWorks: function (id, $item) {
        var self = this;

        fetch(self.action, {
            method: 'post',
            credentials: 'include',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                type: id
            })
        }).then(function (response) {
            return response.json()
        }).then(function (json) {
            self.setActive($item);
            self.replaceWorks(json);
        })
        .catch(function (error) {
            console.log('error');
        });

        return this;
    },
    controls: function () {
        var self = this;

        $(document).on('click', '[data-fd-works-filter]', function (event) {
            event.preventDefault();
            if (!self.locked) {
                var val = $(this).attr('data-fd-works-filter'),
                    $current = $(this).parents('[data-fd-works-menu-item]').eq(0);
                self.getWorks(val, $current);
            }
        });

        return this;
    }
};
/*global window, setTimeout, document, module, matchMedia */
/**
 * @author Valeriy Siestov
 *
 * @description Main JS object of this site
 * @namespace
 * @property {object} browser - Contains data about browser and operation system
 */
var FRONDEVO = {
    controls: {
        desktop: matchMedia('(min-width: 1024px)')
    },
    browser: (function () {

        var os = '',
            version,
            ua = window.navigator.userAgent,
            platform = window.navigator.platform,
            result = {

                /**
                 * Contain operation system
                 *
                 * @member {Object}
                 */
                os: {
                    win: false,
                    mac: false,
                    linux: false,
                    android: false,
                    ios: false
                },

                /**
                 * Contain current browser
                 *
                 * @member {Object}
                 */
                browser: {
                    opera: false,
                    ie: false,
                    firefox: false,
                    chrome: false,
                    safari: false,
                    android: false
                },
                version: 0
            };

        if (/MSIE/.test(ua)) {
            version = /MSIE \d+[.]\d+/.exec(ua)[0].split(' ')[1];
            result.browser.ie = true;
            result.version = parseInt(version, 10);
        } else if (/Android/.test(ua)) {
            result.os.android = true;
            result.browser.android = true;

            if (/Chrome/.test(ua)) {
                version = /Chrome\/[\d\.]+/.exec(ua)[0].split('/')[1];
                result.version = parseInt(version, 10);
                result.browser.chrome = true;

                result.browser.android = false;
            }

            if (/Firefox/.test(ua)) {
                version = /Firefox\/[\.\d]+/.exec(ua)[0].split('/')[1];
                result.browser.firefox = true;
                result.version = parseInt(version, 10);

                result.browser.android = false;
            }

        } else if (/Chrome/.test(ua)) {
            version = /Chrome\/[\d\.]+/.exec(ua)[0].split('/')[1];
            result.browser.chrome = true;
            result.version = parseInt(version, 10);
        } else if (/Opera/.test(ua)) {
            result.browser.opera = true;
        } else if (/Firefox/.test(ua)) {
            version = /Firefox\/[\.\d]+/.exec(ua)[0].split('/')[1];
            result.browser.firefox = true;
            result.version = parseInt(version, 10);
        } else if (/Safari/.test(ua)) {

            if ((/iPhone/.test(ua)) || (/iPad/.test(ua)) || (/iPod/.test(ua))) {
                result.os.ios = true;
            }

            result.browser.safari = true;
        }

        if (!version) {

            version = /Version\/[\.\d]+/.exec(ua);

            if (version) {

                if (version) {
                    version = version[0].split('/')[1];
                } else {
                    version = /Opera\/[\.\d]+/.exec(ua)[0].split('/')[1];
                }

                result.version = parseInt(version, 10);
            } else {

                if (document.all.length) {
                    result.version = 11;
                    result.browser.ie = true;
                }

            }
        }

        if (platform === 'MacIntel' || platform === 'MacPPC') {
            result.os.mac = true;
        } else if (platform === 'Win32' || platform === 'Win64') {
            result.os.win = true;
        } else if (!os && /Linux/.test(platform)) {
            result.os.linux = true;
        } else if (!os && /Windows/.test(ua)) {
            result.os.win = true;
        } else if (!os && /android/.test(ua)) {
            result.os.android = true;
        }

        return result;

    }()),

    /**
     * Global functions
     *
     * @type {object}
     */
    global: {
        addEvents: function (list, event, handler) {
            var count = list.length,
                i;

            for (i = 0; i < count; i++) {
                list[i].addEventListener(event, handler, false);
            }
        },

        /**
         * Save touch state and position
         *
         * @method
         * @memberOf FRONDEVO
         * @param {Object} event - Touch event object
         */
        touchScrollStart: function (event) {
            "use strict";

            event.stopPropagation();
            this.allowUp = (this.scrollTop > 0);
            this.allowDown = (this.scrollTop < this.scrollHeight - this.clientHeight);
            this.lastY = event.touches[0].clientY;
        },

        /**
         * Check and process touch scrolling position
         *
         * @method
         * @memberOf FRONDEVO
         * @param {Object} event - Touch event object
         */
        touchScrollProcessing: function (event) {
            "use strict";

            if (FRONDEVO.controls.desktop.matches) {
                return;
            }

            var up = (event.touches[0].clientY > this.lastY),
                down = !up;

            this.lastY = event.touches[0].clientY;

            if ((up && this.allowUp) || (down && this.allowDown)) {
                event.stopPropagation();
            } else {
                if (this.scrollHeight !== this.clientHeight || this.scrollHeight + 1 !== this.clientHeight) {
                    event.preventDefault();
                }
            }
        },

        /**
         * Stretch object by rules of cover
         *
         * @memberOf FRONDEVO
         * @param {HTMLElement} object
         * @param {number} viewPortWidth
         * @param {number} viewPortHeight
         */
        cover: function (object, viewPortWidth, viewPortHeight) {
            "use strict";

            var viewPortRatio = viewPortWidth / viewPortHeight,
                imageRatio,
                resultWidth,
                resultHeight,
                hiddenTop = 0,
                hiddenLeft = 0;

            object.style.display = 'none'; // need for correct rendering in firefox (start)

            object.style.width = 'auto';
            object.style.height = 'auto';
            object.style.top = '';
            object.style.left = '';
            object.removeAttribute('width');
            object.removeAttribute('height');

            object.style.display = '';  // need for correct rendering in firefox (end)

            imageRatio = (object.width || object.videoWidth) / (object.height || object.videoHeight);

            if (imageRatio <= viewPortRatio) {
                resultWidth = viewPortWidth;
                resultHeight =  viewPortWidth / imageRatio;

                hiddenTop = (viewPortHeight - resultHeight) / 2;
            } else {
                resultWidth = viewPortHeight * imageRatio;
                resultHeight = viewPortHeight;

                hiddenLeft = (viewPortWidth - resultWidth) / 2;
            }

            object.style.display = 'none'; // need for correct rendering in firefox (start)

            object.width = resultWidth;
            object.height = resultHeight;
            object.style.width = resultWidth + 'px';
            object.style.height = resultHeight + 'px';
            object.style.top = hiddenTop + 'px';
            object.style.left = hiddenLeft + 'px';
            object.style.objectFit = 'unset';
            object.style.display = '';  // need for correct rendering in firefox (end)
        },

        /**
         * Stretch object by rules of contain
         *
         * @memberOf FRONDEVO
         * @param {HTMLElement} object
         * @param {number} viewPortWidth
         * @param {number} viewPortHeight
         */
        contain: function (object, viewPortWidth, viewPortHeight) {
            "use strict";

            var viewPortRatio = viewPortWidth / viewPortHeight,
                imageRatio = object.width / object.height,
                resultWidth,
                resultHeight,
                hiddenTop = 0,
                hiddenLeft = 0;

            if (imageRatio <= viewPortRatio) {
                resultWidth = viewPortHeight * imageRatio;
                resultHeight =  viewPortHeight;

                hiddenLeft = (viewPortWidth - resultWidth) / 2;
            } else {
                resultWidth = viewPortWidth;
                resultHeight = viewPortWidth / imageRatio;

                hiddenTop = (viewPortHeight - resultHeight) / 2;
            }

            object.width = resultWidth;
            object.height = resultHeight;
            object.style.width = resultWidth + 'px';
            object.style.height = resultHeight + 'px';
            object.style.top = hiddenTop + 'px';
            object.style.left = hiddenLeft + 'px';
        },

        fixFit: function (list) {
            var count = list.length,
                i,
                global = FRONDEVO.global,
                cover = global.cover,
                contain = global.contain,
                tempParent;

            if (window.CSS && CSS.supports('object-position', 'left top') && !FRONDEVO.browser.browser.firefox) {
                return;
            }

            for (i = 0; i < count; i++) {
                tempParent = list[i].parentNode;

                if (list[i].getAttribute('data-fit') === 'cover') {
                    cover(list[i], tempParent.clientWidth, tempParent.clientHeight);
                } else {
                    contain(list[i], tempParent.clientWidth, tempParent.clientHeight);
                }

            }

        },

        resizeForObjectFit: function (event) {
            var ctrl = FRONDEVO.controls,
                list = ctrl.objectFitList;

            clearTimeout(ctrl.resizeTimeout);
            ctrl.resizeTimeout = setTimeout(function () {
                FRONDEVO.global.fixFit(list);
            }, 500);
        },

        transitionEnd: function (event) {
            if ($(event.target).hasClass('tEndElement') || $(event.target).hasClass('tEndElement2')) {
                if ($(event.target).data('tcallback')) {
                    var callback = $(event.target).data('tcallback');
                    if (event.originalEvent.propertyName.indexOf(callback.prop) > -1) {
                        if (typeof callback.callback === 'function') {
                            callback.callback();
                        }
                    }

                }
            }

        },

        transitionEnd2: function (event) {
            if ($(event.target).hasClass('tEl')) {
                if ($(event.target).data('tcallback')) {
                    var callback = $(event.target).data('tcallback');

                    console.log('!!!');

                    if (event.originalEvent.propertyName.indexOf(callback.prop) > -1) {
                        if (typeof callback.callback === 'function') {
                            callback.callback();
                        }
                    }

                }
            }

        },

        formSubmit: function (event) {
            var form = event.target,
                formData;

            if (!module.validation.check(form)) {
                event.preventDefault();
                return;
            }

            if (!form.hasAttribute('data-ajax')) {
                return;
            }

            event.preventDefault();

            $(form).addClass('loading');
            formData = new FormData(form);

            fetch(form.getAttribute('action'), {
                method: form.getAttribute('method'),
                body: formData
            }).then(function (response) {
                module.listener.exec(form.getAttribute('id'), response);
                TweenMax.to(window, 0.3, {
                    scrollTo : { y: 0},
                    ease: Power1.easeOut
                });
            }).catch(function (error) {
                console.error('submit form error', error);
            });
        },

        formApplicationReceive: function (response) {
            var middle = document.querySelector('.middle-text'),
                answer = document.querySelector('.form-answer span');

            response.json().then(function (json) {
                answer.innerHTML = json.message;

                middle.classList.add('response');
            });
        }
    },

    /**
     * Get site controls
     *
     * @method
     * @memberOf FRONDEVO
     */
    getControls: function () {
        var ctrl = FRONDEVO.controls;

        ctrl.siteWrap = document.querySelector('.site-wrap');
    },

    /**
     * Set event listeners
     *
     * @method
     * @memberOf FRONDEVO
     */
    setEventList: function () {
        var ctrl = FRONDEVO.controls,
            global = FRONDEVO.global,
            siteWrap = ctrl.siteWrap;

        if (FRONDEVO.browser.os.ios) {
            global.addEvents([siteWrap], 'touchstart', global.touchScrollStart);
            global.addEvents([siteWrap], 'touchmove', global.touchScrollProcessing);
            window.addEventListener('resize', global.resizeForObjectFit, false);
        }

        $(document).on('transitionend', '.tEndElement', global.transitionEnd);
        $(document).on('transitionend', '.tEndElement2', global.transitionEnd2);
        window.addEventListener('submit', function (event) {
            // form validate apply
            $('[data-fld-attr-required]').each(function (key, value) {
                $.each( value.attributes, function( index, attr ) {
                    if (attr.name.search('data-fld-attr-') > -1) {
                        var realAttr = attr.name.match(/data-fld-attr-(.+)/)[1];
                        $(value).attr(realAttr, '');
                    }
                } );
            });

            global.formSubmit(event);
        }, false);

        if (window.module && module.listener) {
            module.listener.add({name: 'form-application', handler: global.formApplicationReceive});
        }

        // form start validate fix
        $('input').on('blur', function () {
            var el = this;
            $.each( el.attributes, function( index, attr ) {
                if (attr.name.search('data-fld-attr-') > -1) {
                    var realAttr = attr.name.match(/data-fld-attr-(.+)/)[1];
                    $(el).attr(realAttr, '');
                }
            } );
        });

        // scroll to by click on start screen's btn
        $('.full-height__layout .arrow').on('click', function () {
            TweenMax.to($(window), 1, {
                scrollTo: {y: $(window).height() * 0.4},
                ease:Power2.easeInOut
            });
        });

    },

    /**
     * Set startup configuration
     *
     * @method setConfig
     * @memberOf FRONDEVO
     */
    setConfig: function () {
        var ctrl = FRONDEVO.controls,
            global = FRONDEVO.global,
            list,
            count,
            i;

        ctrl.objectFitList = list = document.querySelectorAll('[data-fit]');
        count = list.length;

        for (i = 0; i < count; i++) {

            list[i].onload = function () {
                global.fixFit([this]);
            };

            if (list[i].complete) {
                global.fixFit([list[i]]);
            }
        }

        ctrl.isMobDevice = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|touch|opera mini/i
            .test(navigator.userAgent.toLowerCase()));

        ctrl.popup = new Popup();
        if (typeof FDWorks === 'function') {
            ctrl.works = new FDWorks();
        }

        if (window.MainLoader) {
            ctrl.mainLoader = new MainLoader();
        }

        if (window.viewportUnitsBuggyfill) {
            viewportUnitsBuggyfill.init();
        }

        // projects page modules
        if (window.ListScroll) {
            window.scrollDelta = {
                temp: 0,
                now: 1
            };
            ctrl.listScroll = new ListScroll();
        }
        if (window.ListScroll) {
            ctrl.projectsFilter = new ProjectsFilter();
        }

    },

    objectFitPolyfill: function () {
        if (!('object-fit' in document.body.style)) {
            $('[data-fd-object-fit]').each(function (key, value) {
                var src = $(this).attr('src');
                $(value).addClass('invisible');
                $(value).parent().css({'background': 'url(' + src + ')'});
            });
        }
    },

    /**
     * Init functionality of this site
     *
     * @constructs
     * @method init
     * @memberOf FRONDEVO
     */
    init: function () {
        window.addEventListener('DOMContentLoaded', function () {
            FRONDEVO.getControls();
            FRONDEVO.setEventList();
            FRONDEVO.setConfig();
            FRONDEVO.objectFitPolyfill();
        }, false);
    }
};

FRONDEVO.init();
/**
 * Created by valerasiestov on 30.10.15.
 */


if (!window.module) {
    window.module = {};
}

module.listener = (function () {
    "use strict";

    var list = {};

    function add(item) {
        if (!list[item.name]) {
            list[item.name] = item.handler;
        } else {
            console.log('key is exist');
        }
    }

    function exec(key, data) {
        if (list[key]) {
            list[key](data);
        }
    }

    return {
        add: add,
        exec: exec
    };

}());
/**
 * Created by valerasiestov on 28.01.16.
 */


if (!window.module) {
    window.module = {};
}

module.scrollSlide = (function () {
    "use strict";

    var scrollTween,
        controls = {
            scrollTime: 0.3,
            scrollDistance: 150,
            scrollActivity: 1,
            maxScrollActivity: 4,
            desktop: matchMedia('(min-width: 1024px)')
        },
        handlers = {
            scroll: function () {
                var position = window.scrollTop || document.documentElement.scrollTop || document.body.scrollTop,
                    opacity = 1 - position / controls.height;

                if (opacity === 0) {
                    return;
                }

                if (controls.layout && controls.layout.style) {
                    controls.layout.style.cssText = 'opacity: ' + opacity + ';' + 'transform: translate3d(0, ' + (position - (1 - opacity) * controls.height / 2) + 'px, 0);';
                }
                if (controls.image && controls.image.style) {
                    controls.image.style.cssText = 'transform: scale(' + (1 + 0.3 * (1 - opacity)) + ') translate3d(0, 0, 0);';
                }
            },

            resize: function () {
                handlers.getSizes();

                if (controls.desktop.matches) {
                    if (controls.layout && controls.layout.style) {
                        controls.layout.style.cssText = '';
                    }
                    if (controls.layout && controls.image.style) {
                        controls.image.style.cssText = '';
                    }
                }
            },
            
            getSizes: function () {
                controls.height = window.innerHeight;
            },

            mouseWheel: function(event) {

                // set new scroll distance if scrolling is fast
                var newDistance = controls.scrollDistance,
                    newActivity;
                if (scrollTween) {
                    if (scrollTween.isActive()) {
                        newActivity = Math.abs(event.originalEvent.wheelDelta) * 0.001;
                        controls.scrollActivity *= (1 + newActivity);
                        controls.scrollActivity = controls.scrollActivity > controls.maxScrollActivity ? controls.maxScrollActivity : controls.scrollActivity;
                        newDistance = controls.scrollDistance * controls.scrollActivity;
                    } else {
                        controls.scrollActivity = 1;
                        newDistance = controls.scrollDistance;
                    }

                }

                if (!controls.desktop.matches) {
                    return;
                }

                event.preventDefault();

                var delta = event.originalEvent.wheelDelta/120 || -event.originalEvent.detail/3;
                var scrollTop = controls.$window.scrollTop();
                var finalScroll = scrollTop - parseInt(delta * newDistance);

                scrollTween = TweenMax.to(controls.$window, controls.scrollTime, {
                    scrollTo : { y: finalScroll, autoKill:true },
                    ease: Power1.easeOut,
                    autoKill: true,
                    overwrite: 5
                });

            }
        };

    function setEventList() {
        window.addEventListener('scroll', handlers.scroll, false);
        window.addEventListener('resize', handlers.resize, false);

        if (!FRONDEVO.browser.browser.firefox) {
            //$(controls.wrap).on("mousewheel DOMMouseScroll", handlers.mouseWheel);
            $(window).on("mousewheel DOMMouseScroll", handlers.mouseWheel);
        }
    }

    function getControls() {
        var wrap;

        controls.$window = $(window);
        controls.wrap = wrap = document.querySelector('.full-height.inner');
        //controls.image = wrap.querySelector('picture');
        controls.image = $(wrap).find('picture');
        //controls.layout = wrap.querySelector('.full-height__layout');
        controls.layout = $(wrap).find('.full-height__layout');

        handlers.getSizes();
    }

    function init(params) {
        getControls();
        setEventList();
    }

    return {
        init: init
    };

}());

window.addEventListener('DOMContentLoaded', function () {

    module.scrollSlide.init({

    });

}, false);

/**
 * Created by valera.siestov on 24.03.2015.
 */

if (!window.module) {
    window.module = {};
}

/**
 * Check form validate
 *
 * @class Validate
 *
 * @constructor
 */
module.validation = (function () {

    "use strict";

    var Validate = function () {

        /**
         * get error message
         *
         * @param input
         * @returns boolean
         */
        function getErrorMessage(input) {

            function defaultCheck(value) {
                var result = true;

                if (!value.trim().length) {
                    result = false;
                }

                return result;
            }

            function selectCheck(input) {

                var value,
                    result = true,
                    currentSelected,
                    select;


                if ($(input).hasClass('ui-selectmenu')) {
                    currentSelected = $(input).attr('id');
                    select = document.getElementById(currentSelected.replace('-button', ''));

                    value = select.options[select.selectedIndex].value;
                } else {
                    value = input.querySelector('input').value;
                }

                if (!value.length) {
                    result = false;
                }

                return result;
            }

            function emailCheck(value) {
                var validMail = /^[\-._a-z0-9]+@(?:[a-z0-9][\-a-z0-9]+\.)+[a-z]{2,6}$/i.test(value),
                    result = true;

                if (!validMail) {
                    result = false;
                }

                return result;
            }

            function numberCheck(value) {
                var defaultResult = defaultCheck(value);

                if (defaultResult) {
                    return !isNaN(value);
                }

                return defaultResult;
            }

            function checkPassword(value) {
                var defaultResult = defaultCheck(value.value),
                    compare = document.getElementById(value.getAttribute('data-compare'));

                if (defaultResult) {

                    if (!compare) {
                        return true;
                    }

                    if (value.value !== compare.value) {
                        compare.parentNode.classList.add('invalid');

                        if (compare.parentNode.hasAttribute('data-required')) {
                            compare.parentNode.classList.add('tooltip');
                        }

                        return false;
                    }

                } else {
                    return false;
                }

                return true;
            }

            var value = input.value,
                inputType = input.type,
                result = true,
                condition;

            switch (inputType) {
            case 'email':
                result = defaultCheck(value);

                if (result) {
                    result = emailCheck(value);

                    if (!result) {

                        if (input.parentNode.hasAttribute('data-error')) {
                            input.parentNode.classList.add('tooltip-error');
                        }

                    }
                }

                break;

            case 'number':
                result = numberCheck(value);
                break;

            case 'text':
                result = defaultCheck(value);
                break;

            case 'tel':
                result = defaultCheck(value);
                break;

            case 'select':
                result = selectCheck(input);
                break;
            case 'password':
                result = checkPassword(input);
                break;

            default:
                result = defaultCheck(value);
                break;
            }

            if (result) {
                condition = input.getAttribute('data-condition');

                if (condition) {

                    result = false;

                    if (input.value.trim().split(' ').length > 1) {
                        result = true;
                    }

                }
            }

            return result;
        }

        /**
         * check input
         *
         * @param input
         * @returns {boolean}
         */
        function checkInput(input) {
            var type = input.getAttribute('type'),
                tempControl;

            if (input.tagName !== 'SELECT') {
                if (!(input.offsetWidth > 0 && input.offsetHeight > 0)) {
                    return true;
                }
            } else {
                tempControl = input.previousElementSibling;

                if (!(tempControl.offsetWidth > 0 && tempControl.offsetHeight > 0)) {
                    return true;
                }

                if (parseInt(input.value, 10) === -1) {
                    return false;
                }
            }

            if (input.hasAttribute('disabled') || !input.hasAttribute('required')) {
                return true;
            }

            if (input.hasAttribute('data-check')) {
                checkRequest(input);
            }

            return getErrorMessage(input);
        }

        /**
         * check textarea
         *
         * @param textArea
         * @returns {boolean}
         */
        function checkTextArea(textArea) {
            return checkInput(textArea);
        }

        function hideToolTip(input) {
            setTimeout(function () {
                input.classList.remove('tooltip');
                input.classList.remove('invalid');
                input.classList.remove('tooltip-error');
            }, 3000);
        }

        function hideInvalid(input) {
            setTimeout(function () {
                input.classList.remove('invalid');
            }, 3000);
        }

        function checkRequest(input) {
            var url = input.getAttribute('data-check');

            $.ajax({
                url: url,
                type: 'get',
                data: 'value=' + input.value,
                dataType: 'json',
                success: function (response) {
                    if (!response.result) {
                        input.parentNode.classList.add('invalid');

                        if (input.parentNode.hasAttribute('data-required')) {
                            input.parentNode.classList.add('tooltip');
                        }
                    }
                }
            });
        }

        /**
         * check form
         *
         * @param form
         * @param goTo {boolean}
         * @returns {boolean}
         */
        function check(form, goTo) {

            var inputs = form.querySelectorAll('input[required]'),
                inputsLength = inputs.length,
                textArea = form.querySelectorAll('textarea[required]'),
                textAreaLength = textArea.length,
                select = form.querySelectorAll('select[required]'),
                selectCount = select.length,
                i,
                firstErrorElement,
                result = true,
                checkbox = form.querySelectorAll('[type="checkbox"][required]'),
                checkboxCount = checkbox.length;


            for (i = 0; i < inputsLength; i++) {

                if (!checkInput(inputs[i])) {
                    result = false;
                    inputs[i].parentNode.classList.add('invalid');

                    if (inputs[i].parentNode.hasAttribute('data-required')) {
                        inputs[i].parentNode.classList.add('tooltip');
                    }

                    hideToolTip(inputs[i].parentNode);

                    if (!firstErrorElement) {
                        firstErrorElement = inputs[i];
                    }
                }
            }

            for (i = 0; i < textAreaLength; i++) {
                if (!checkTextArea(textArea[i])) {
                    result = false;
                    textArea[i].parentNode.classList.add('invalid');

                    if (textArea[i].parentNode.hasAttribute('data-required')) {
                        textArea[i].parentNode.classList.add('tooltip');
                    }

                    hideToolTip(textArea[i].parentNode);

                    if (!firstErrorElement) {
                        firstErrorElement = textArea[i];
                    }
                }
            }

            for (i = 0; i < selectCount; i++) {
                if (!checkInput(select[i])) {
                    result = false;
                    select[i].parentNode.classList.add('invalid');

                    if (select[i].parentNode.hasAttribute('data-required')) {
                        select[i].parentNode.classList.add('tooltip');
                    }

                    hideToolTip(select[i].parentNode);

                    if (!firstErrorElement) {
                        firstErrorElement = select[i];
                    }
                }
            }

            for (i = 0; i < checkboxCount; i++) {
                if (!checkbox[i].checked) {
                    result = false;
                    checkbox[i].parentNode.classList.add('invalid');

                    hideInvalid(checkbox[i].parentNode);

                    if (!firstErrorElement) {
                        firstErrorElement = checkbox[i];
                    }
                }
            }

            if (goTo) {
                if (firstErrorElement) {
                    //var wrap = $('.site-wrap'),
                    //    elementPosition = $(firstErrorElement).parent().offset().top;
                    //
                    //wrap.animate({
                    //    scrollTop: wrap.scrollTop() + elementPosition - 106
                    //});
                    $('html,body').animate({
                        scrollTop: $(firstErrorElement).parent().offset().top
                    });
                }
            }

            return result;
        }

        /**
         * check form
         *
         * @public
         * @method check
         * @param form
         * @param goTo {boolean}
         * @returns {boolean}
         */
        this.check = function (form, goTo) {
            return check(form, goTo);
        };

        /**
         * Check input
         *
         * @public
         * @method checkInput
         * @param inputObject
         * @returns {boolean}
         */
        this.checkInput = function (inputObject) {
            return checkInput(inputObject);
        };

        /**
         * Init validate class
         *
         * @method init
         */
        function init() {
        }
        return init();
    };

    return new Validate();
}());

